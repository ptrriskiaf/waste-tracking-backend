<!DOCTYPE html>
<html>
<head>
    <title>Tracking Kendaraan Limbah</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        #map { height: 400px; width: 100%; margin-top: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        button { padding: 5px 10px; cursor: pointer; }
    </style>
</head>
<body>
<h1>Daftar Perusahaan</h1>
<table id="perusahaanTable">
  <thead>
    <tr>
      <th>Nama</th>
      <th>Alamat</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>

<h2>Daftar Kendaraan</h2>
<table id="kendaraanTable">
  <thead>
    <tr>
      <th>No Polisi</th>
      <th>Merk</th>
      <th>Jenis</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>

<h2>Tracking Lokasi</h2>
<div id="map"></div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
let map = L.map('map').setView([-6.2, 106.8], 10);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

const perusahaanTable = document.querySelector("#perusahaanTable tbody");
const kendaraanTable = document.querySelector("#kendaraanTable tbody");

// Load semua perusahaan
axios.get('/api/perusahaan', { headers: { Accept: 'application/json' } })
.then(res => {
  res.data.forEach(p => {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${p.nama}</td>
      <td>${p.alamat}</td>
      <td><button onclick="loadKendaraan(${p.id})">Lihat Kendaraan</button></td>
    `;
    perusahaanTable.appendChild(row);
  });
});

// Load kendaraan berdasarkan perusahaan
function loadKendaraan(perusahaanId) {
  axios.get(`/api/perusahaan/${perusahaanId}`, { headers: { Accept: 'application/json' } })
  .then(res => {
    kendaraanTable.innerHTML = '';
    res.data.kendaraan.forEach(k => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${k.no_polisi}</td>
        <td>${k.merk}</td>
        <td>${k.jenis}</td>
        <td><button onclick="loadLokasi(${k.id})">Tracking</button></td>
      `;
      kendaraanTable.appendChild(row);
    });
  });
}

// Load lokasi kendaraan
function loadLokasi(kendaraanId) {
  axios.get(`/api/lokasi-kendaraan?kendaraan_id=${kendaraanId}`, { headers: { Accept: 'application/json' } })
  .then(res => {
    // Hapus marker sebelumnya
    map.eachLayer(layer => {
      if(layer instanceof L.Marker) map.removeLayer(layer);
    });

    if(res.data.length === 0) return;

    const bounds = [];
    res.data.forEach(loc => {
      const marker = L.marker([loc.lat, loc.lng])
        .addTo(map)
        .bindPopup(`Speed: ${loc.speed ?? '-'} km/h<br>Waktu: ${loc.recorded_at}`);
      bounds.push([loc.lat, loc.lng]);
    });

    map.fitBounds(bounds, { padding: [50, 50] });
  });
}
</script>
</body>
</html>
