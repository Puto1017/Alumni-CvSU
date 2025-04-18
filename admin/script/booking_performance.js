// import { populateYears } from "./essentials.js";

// document.addEventListener("DOMContentLoaded", function () {
//     populateYears("performanceSelect", 2024); // Populates years

//     const chartElement = document.getElementById('bookingChart');
//     const bookingStatusChartElement = document.getElementById('bookingStatusChart');
//     const roomOccupancyChartElement = document.getElementById('roomOccupancyChart');
//     const performanceSelect = document.getElementById('performanceSelect');

//     let bookingChart;
//     let bookingStatusChart;
//     let roomOccupancyChart;

//     if (!bookingStatusChartElement || !roomOccupancyChartElement || !chartElement || !performanceSelect) {
//         console.error("Error: Chart element or year select not found!");
//         return;
//     }

//     function fetchBookingTrends(year) {
//         fetch(`/Alumni-CvSU/admin/analytics/get_booking_trends.php?year=${year}`)
//             .then(response => response.json())
//             .then(data => {
//                 if (!Array.isArray(data) || data.length === 0) {
//                     console.warn("No booking trends data available.");
//                     return;
//                 }

//                 const labels = data.map(item => item.month);
//                 const revenueValues = data.map(item => item.total_revenue);

//                 if (bookingChart) {
//                     bookingChart.destroy();
//                 }

//                 const ctx = chartElement.getContext('2d');
//                 bookingChart = new Chart(ctx, {
//                     type: 'line',
//                     data: {
//                         labels: labels,
//                         datasets: [{
//                             label: 'Total Revenue',
//                             data: revenueValues,
//                             borderColor: 'green',
//                             backgroundColor: 'rgba(0, 255, 0, 0.2)',
//                             borderWidth: 2,
//                             tension: 0.4
//                         }]
//                     },
//                     options: {
//                         responsive: true,
//                         maintainAspectRatio: false,
//                         plugins: {
//                             tooltip: {
//                                 callbacks: {
//                                     label: function (tooltipItem) {
//                                         return `Revenue: ${revenueValues[tooltipItem.dataIndex]}`;
//                                     }
//                                 }
//                             },
//                             legend: { display: true }
//                         },
//                         scales: {
//                             x: { title: { display: true, text: 'Month' } },
//                             y: { title: { display: true, text: 'Total Revenue' }, beginAtZero: true }
//                         }
//                     }
//                 });
//             })
//             .catch(error => console.error("Fetch error:", error.message));
//     }

//     function fetchBookingStatus(year) {
//         fetch(`/Alumni-CvSU/admin/analytics/get_booking_status.php?year=${year}`)
//             .then(response => response.json())
//             .then(data => {
//                 if (!Array.isArray(data) || data.length === 0) {
//                     console.warn("No booking status data available.");
//                     return;
//                 }

//                 const labels = data.map(item => item.status);
//                 const values = data.map(item => item.total_bookings);
//                 const colors = ['#4BC0C0', '#FF6384', '#36A2EB', '#FFCE56', '#9966FF', '#FF9F40'];

//                 if (bookingStatusChart) {
//                     bookingStatusChart.destroy();
//                 }

//                 const ctx = bookingStatusChartElement.getContext('2d');
//                 bookingStatusChart = new Chart(ctx, {
//                     type: 'doughnut',
//                     data: {
//                         labels: labels,
//                         datasets: [{ label: 'Booking Status', data: values, backgroundColor: colors, borderWidth: 1 }]
//                     },
//                     options: {
//                         responsive: true,
//                         maintainAspectRatio: false,
//                         plugins: { legend: { display: true, position: 'top' } }
//                     }
//                 });
//             })
//             .catch(error => console.error("Fetch error:", error.message));
//     }

//     function fetchRoomOccupancy(year) {
//         fetch(`/Alumni-CvSU/admin/analytics/get_room_occupancy.php?year=${year}`)
//             .then(response => response.json())
//             .then(data => {
//                 if (!Array.isArray(data) || data.length === 0) {
//                     console.warn("No room occupancy data available.");
//                     return;
//                 }

//                 const roomMap = new Map();
//                 data.forEach(item => {
//                     const roomKey = `Room ${item.room_number}`;
//                     if (!roomMap.has(roomKey)) {
//                         roomMap.set(roomKey, 0);
//                     }
//                     roomMap.set(roomKey, roomMap.get(roomKey) + item.total_bookings);
//                 });

//                 const labels = [...roomMap.keys()].sort((a, b) => parseInt(a.replace("Room ", "")) - parseInt(b.replace("Room ", "")));
//                 const values = labels.map(room => roomMap.get(room));
//                 const colors = labels.map((_, i) => `hsl(${(i * 30) % 360}, 70%, 50%)`);

//                 if (roomOccupancyChart) {
//                     roomOccupancyChart.destroy();
//                 }

//                 const ctx = roomOccupancyChartElement.getContext('2d');
//                 roomOccupancyChart = new Chart(ctx, {
//                     type: 'bar',
//                     data: {
//                         labels: labels,
//                         datasets: [{ label: 'Room Occupancy', data: values, backgroundColor: colors, borderWidth: 1 }]
//                     },
//                     options: {
//                         responsive: true,
//                         maintainAspectRatio: false,
//                         plugins: { legend: { display: true, position: 'top' } },
//                         scales: {
//                             x: { title: { display: true, text: 'Room Number' } },
//                             y: { title: { display: true, text: 'Total Bookings' }, beginAtZero: true }
//                         }
//                     }
//                 });
//             })
//             .catch(error => console.error("Fetch error:", error.message));
//     }

//     const performanceYear = performanceSelect.value;
//     fetchBookingTrends(performanceYear);
//     fetchBookingStatus(performanceYear);
//     fetchRoomOccupancy(performanceYear);

//     performanceSelect.addEventListener("change", function () {
//         const selectedYear = this.value;
//         fetchBookingTrends(selectedYear);
//         fetchBookingStatus(selectedYear);
//         fetchRoomOccupancy(selectedYear);
//     });
// });
