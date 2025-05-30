<?php
include 'main_db.php';
$today = date('Y-m-d');
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="asset/css/home.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        :root {
            --primary-color: #10b981;
            --primary-dark: #059669;
            --secondary-color: #64748b;
            --secondary-hover: #4b5563;
            --border-color: #e2e8f0;
            --danger-color: #ef4444;
            --danger-hover: #dc2626;
            --success-color: #10b981;
            --success-hover: #059669;
            --warning-color: #f59e0b;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --bg-primary: #ffffff;
            --bg-secondary: #f8fafc;
            --white: #ffffff;
            --radius-sm: 4px;
            --radius-md: 6px;
            --radius-lg: 8px;
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --transition: all 0.2s ease;
        }

        .dashboard-container {
            background: var(--bg-primary);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .report-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .select-all-btn,
        .select-none-btn,
        .reset-filter-btn {
            padding: 8px 12px;
            font-size: 14px;
            font-weight: bold;
            color: var(--white);
            border: none;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: var(--transition);
        }

        .select-all-btn {
            background-color: var(--primary-color);
        }

        .select-none-btn {
            background-color: var(--danger-color);
        }

        .reset-filter-btn {
            background-color: var(--secondary-color);
        }

        .select-all-btn:hover {
            background-color: var(--primary-dark);
        }

        .select-none-btn:hover {
            background-color: var(--danger-hover);
        }

        .reset-filter-btn:hover {
            background-color: var(--secondary-hover);
        }

        .toggle-report {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            color: var(--text-primary);
        }

        .toggle-input {
            appearance: none;
            width: 36px;
            height: 20px;
            background-color: var(--bg-secondary);
            border-radius: 20px;
            position: relative;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .toggle-input:checked {
            background-color: var(--primary-color);
        }

        .toggle-input:before {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background-color: var(--white);
            top: 2px;
            left: 2px;
            transition: transform 0.2s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .toggle-input:checked:before {
            transform: translateX(16px);
        }

        .filter-bar {
            background-color: var(--bg-primary);
            border-radius: var(--radius-lg);
            padding: 16px 24px;
            box-shadow: var(--shadow-md);
            margin-bottom: 24px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: center;
        }

        .filter-actions {
            display: flex;
            gap: 8px;
            margin-left: auto;
        }

        .dashboard-header {
            padding: 24px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dashboard-title {
            font-size: 24px;
            color: var(--text-primary);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .button {
            padding: 10px 16px;
            border-radius: var(--radius-lg);
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        @media (max-width: 768px) {

            .dashboard-header,
            .dashboard-content {
                padding: 16px;
            }

            .filter-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-actions {
                margin-left: 0;
                justify-content: space-between;
            }
        }
    </style>
</head>

<body>
    <!-- NEW DASHBOARD -->

    <!-- Filters -->

    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1 class="dashboard-title">Analytics</h1>
            <div class="report-controls">
                <button id="printReport">Print Report</button>
            </div>
        </div>
        <div class="dashboard-row">
            <div class="analytics-card">
                <!-- <div class="analytics-header">
                    <h2>Filters</h2>
                    <div class="report-controls">
                        <button id="printReport">Print Report</button>
                    </div>
                </div> -->
                <div class="filter-bar">
                    <div class="filter-group">
                        <label class="filter-label" for="yearFilter">Year:</label>
                        <select id="yearFilter" class="filter-select"></select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label" for="monthFilter">Month:</label>
                        <select id="monthFilter" class="filter-select"></select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label" for="userTypeFilter">User Type:</label>
                        <select id="userTypeFilter" class="filter-select"></select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label" for="roomFilter">Room Number:</label>
                        <select id="roomFilter" class="filter-select"></select>
                    </div>
                    <div class="filter-actions">
                        <button class="button reset-filter-btn" id="resetFilters">Reset Filters</button>
                        <button class="button select-all-btn" id="selectAllCharts">Select All</button>
                        <button class="button select-none-btn" id="deselectAllCharts">Deselect All</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- OVERVIEW -->
        <div class="dashboard-row">
            <div class="analytics-card">
                <div class="analytics-header">
                    <h2>Total Bookings by Day</h2>
                    <label class="toggle-report">
                        <input type="checkbox" class="toggle-input report-checkbox" value="dailyBookings" checked>
                        <span class="toggle-label">Include in Report</span>
                    </label>
                </div>
                <div class="analytics-content">
                    <canvas id="bookingByDayChart"></canvas>
                </div>
            </div>
            <div class="analytics-card">
                <div class="analytics-header">
                    <h2>Total Bookings by Month</h2>
                    <label class="toggle-report">
                        <input type="checkbox" class="toggle-input report-checkbox" value="monthlyBookings" checked>
                        <span class="toggle-label">Include in Report</span>
                    </label>
                </div>
                <div class="analytics-content">
                    <canvas id="bookingByMonthChart"></canvas>
                </div>
            </div>
            <div class="analytics-card">
                <div class="analytics-header">
                    <h2>Cancellation & No-Show Rate</h2>
                    <label class="toggle-report">
                        <input type="checkbox" class="toggle-input report-checkbox" value="cancellationData" checked>
                        <span class="toggle-label">Include in Report</span>
                    </label>
                </div>
                <div class="analytics-content">
                    <canvas id="cancellationChart"></canvas>
                </div>
            </div>
        </div>
        <!-- TRENDS & PATTERNS -->
        <div class="dashboard-row">
            <div class="analytics-card">
                <div class="analytics-header">
                    <h2>Booking Lead Time</h2>
                    <label class="toggle-report">
                        <input type="checkbox" class="toggle-input report-checkbox" value="leadTimeData" checked>
                        <span class="toggle-label">Include in Report</span>
                    </label>
                </div>
                <div class="analytics-content">
                    <canvas id="bookingLeadTimeChart"></canvas>
                </div>
            </div>
            <div class="analytics-card">
                <div class="analytics-header">
                    <h2>Booking Peak Hours</h2>
                    <label class="toggle-report">
                        <input type="checkbox" class="toggle-input report-checkbox" value="peakHoursData" checked>
                        <span class="toggle-label">Include in Report</span>
                    </label>
                </div>
                <div class="analytics-content">
                    <canvas id="peakBookingChart"></canvas>
                </div>
            </div>
        </div>

    </div>


    <!-- <div class="bookings-table-container">
        <div class="header-content">
            <h2>Recent Bookings</h2>
            <a href="?section=view-all-bookings" class="view-all-link">
                <i class="fas fa-external-link-alt"></i>
                View All
            </a>
        </div>
        <div class="table-responsive">
            <table class="bookings-table">
                <thead>
                    <tr>
                        <th>Reference/User</th>
                        <th>Room</th>
                        <th class="hide-mobile">Check In</th>
                        <th class="hide-mobile">Check Out</th>
                        <th class="hide-mobile">Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Updated query to include user_id
                    $query = "SELECT b.*, u.id as user_id 
                             FROM bookings b 
                             LEFT JOIN users u ON b.user_id = u.id 
                             ORDER BY b.created_at DESC LIMIT 3";
                    $result = $mysqli->query($query);

                    if ($result && $result->num_rows > 0) {
                        while ($booking = $result->fetch_assoc()) {
                            $statusClass = '';
                            $statusIcon = '';

                            switch ($booking['status']) {
                                case 'pending':
                                    $statusClass = 'status-pending';
                                    $statusIcon = '<i class="fas fa-clock"></i>';
                                    break;
                                case 'confirmed':
                                    $statusClass = 'status-confirmed';
                                    $statusIcon = '<i class="fas fa-check"></i>';
                                    break;
                                case 'checked_in':
                                    $statusClass = 'status-checked_in';
                                    $statusIcon = '<i class="fas fa-door-open"></i>';
                                    break;
                                case 'cancelled':
                                    $statusClass = 'status-cancelled';
                                    $statusIcon = '<i class="fas fa-times-circle"></i>';
                                    break;
                                case 'no_show':
                                    $statusClass = 'status-no_show';
                                    $statusIcon = '<i class="fas fa-user-slash"></i>';
                                    break;
                                case 'completed':
                                    $statusClass = 'status-completed';
                                    $statusIcon = '<i class="fas fa-check-double"></i>';
                                    break;
                            }

                    ?>
                            <tr data-user-id="<?php echo htmlspecialchars($booking['user_id']); ?>">
                                <td><?php echo htmlspecialchars($booking['reference_number']); ?></td>
                                <td>
                                    Room <?php echo htmlspecialchars($booking['room_number']); ?><br>
                                    <small>Occupancy: <?php echo htmlspecialchars($booking['occupancy']); ?></small>
                                </td>
                                <td class="hide-mobile">
                                    <?php
                                    echo date('M d, Y', strtotime($booking['arrival_date'])) . '<br>';
                                    echo '<small>' . htmlspecialchars($booking['arrival_time']) . '</small>';
                                    ?>
                                </td>
                                <td class="hide-mobile">
                                    <?php
                                    echo date('M d, Y', strtotime($booking['departure_date'])) . '<br>';
                                    echo '<small>' . htmlspecialchars($booking['departure_time']) . '</small>';
                                    ?>
                                </td>
                                <td class="hide-mobile">₱<?php echo number_format($booking['price'], 2); ?></td>
                                <td>
                                    <span class="status-badge <?php echo $statusClass; ?>">
                                        <?php echo $statusIcon . ' ' . ucfirst(str_replace('_', ' ', $booking['status'])); ?>
                                    </span>

                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="7" class="text-center">No bookings found</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div> -->

    <!-- User Details Modal -->
    <div id="bookingUserModal" class="booking-user-modal">
        <div class="booking-modal-content">
            <div class="booking-modal-header">
                <h2>Booking Details</h2>
                <span class="booking-modal-close">&times;</span>
            </div>
            <div class="booking-modal-body">
                <div class="booking-user-details">
                    <h3>User Information</h3>
                    <div class="booking-detail-grid">
                        <div class="booking-detail-item">
                            <label>Username:</label>
                            <span id="booking-modal-username"></span>
                        </div>
                        <div class="booking-detail-item">
                            <label>Email:</label>
                            <span id="booking-modal-email"></span>
                        </div>
                        <div class="booking-detail-item">
                            <label>Full Name:</label>
                            <span id="booking-modal-fullname"></span>
                        </div>
                        <div class="booking-detail-item">
                            <label>Position:</label>
                            <span id="booking-modal-position"></span>
                        </div>
                        <div class="booking-detail-item">
                            <label>Address:</label>
                            <span id="booking-modal-address"></span>
                        </div>
                        <div class="booking-detail-item">
                            <label>Second Address:</label>
                            <span id="booking-modal-second-address"></span>
                        </div>
                        <div class="booking-detail-item">
                            <label>Telephone:</label>
                            <span id="booking-modal-telephone"></span>
                        </div>
                        <div class="booking-detail-item">
                            <label>Phone Number:</label>
                            <span id="booking-modal-phone"></span>
                        </div>
                        <div class="booking-detail-item">
                            <label>Accompanying Persons:</label>
                            <span id="booking-modal-accompanying"></span>
                        </div>
                        <div class="booking-detail-item">
                            <label>User Status:</label>
                            <span id="booking-modal-user-status"></span>
                        </div>
                        <div class="booking-detail-item">
                            <label>Verification Status:</label>
                            <span id="booking-modal-verified"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.querySelectorAll('.bookings-table tbody tr').forEach(row => {
            row.addEventListener('click', async function(e) {
                if (e.target.classList.contains('status-select') ||
                    e.target.closest('.status-select')) {
                    return;
                }

                const userId = this.getAttribute('data-user-id');
                console.log('Clicked row user ID:', userId);

                if (!userId) {
                    console.error('No user ID found for this booking');
                    return;
                }

                const modal = document.getElementById('bookingUserModal');
                modal.style.display = "block";

                try {
                    const formData = new FormData();
                    formData.append('user_id', userId);

                    console.log('Sending request to get user details...');
                    const response = await fetch('/Alumni-CvSU/admin/get_user_details.php', {
                        method: 'POST',
                        body: formData
                    });

                    if (!response.ok) {
                        throw new Error(`Server returned ${response.status}: ${response.statusText}`);
                    }

                    const data = await response.json();

                    if (!data.success) {
                        throw new Error(data.message || 'Failed to load user details');
                    }

                    const updateField = (id, value, defaultValue = 'N/A') => {
                        const element = document.getElementById(id);
                        if (element) {
                            element.textContent = value || defaultValue;
                        }
                    };

                    updateField('booking-modal-username', data.user.username);
                    updateField('booking-modal-email', data.user.email);

                    const fullName = [
                        data.user_details.first_name,
                        data.user_details.middle_name,
                        data.user_details.last_name
                    ].filter(Boolean).join(' ');
                    updateField('booking-modal-fullname', fullName);

                    updateField('booking-modal-position', data.user_details.position);
                    updateField('booking-modal-address', data.user_details.address);
                    updateField('booking-modal-second-address', data.user_details.second_address);
                    updateField('booking-modal-telephone', data.user_details.telephone);
                    updateField('booking-modal-phone', data.user_details.phone_number);
                    updateField('booking-modal-accompanying', data.user_details.accompanying_persons);
                    updateField('booking-modal-user-status', data.user_details.user_status);
                    updateField('booking-modal-verified', data.user_details.verified ? 'Verified' : 'Not Verified');

                } catch (error) {
                    console.error('Error fetching user details:', error);
                    const modalBody = document.querySelector('.booking-modal-body');

                    const errorMessage = document.createElement('div');
                    errorMessage.className = 'error-message';
                    errorMessage.style.cssText = 'color: red; padding: 10px; margin: 10px; background-color: #fee2e2; border: 1px solid #ef4444; border-radius: 4px;';
                    errorMessage.textContent = `Error: ${error.message}. Please try again.`;

                    modalBody.insertBefore(errorMessage, modalBody.firstChild);
                }
            });
        });

        const bookingModal = document.getElementById('bookingUserModal');
        const closeBtn = document.querySelector('.booking-modal-close');

        closeBtn.onclick = function() {
            bookingModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == bookingModal) {
                bookingModal.style.display = "none";
            }
        }

        // Booking status update functionality
        document.querySelectorAll('.status-select').forEach(select => {
            select.addEventListener('change', async function() {
                const bookingId = this.dataset.bookingId;
                const newStatus = this.value;

                try {
                    const response = await fetch('update_booking_status.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `booking_id=${bookingId}&status=${newStatus}`
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const data = await response.json();

                    if (data.success) {
                        // Update the status badge
                        const statusBadge = this.closest('tr').querySelector('.status-badge');
                        statusBadge.className = `status-badge status-${newStatus}`;
                        statusBadge.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);

                        // Show success message
                        alert('Status updated successfully!');
                    } else {
                        throw new Error(data.message || 'Error updating status');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Error updating status. Please try again.');
                    // Reset select to previous value
                    this.value = this.querySelector('[selected]').value;
                }
            });
        });

        // Number animation for stat cards
        document.addEventListener('DOMContentLoaded', function() {
            const numbers = document.querySelectorAll('.stat-content h3');

            numbers.forEach(number => {
                const finalValue = parseInt(number.textContent);
                let startValue = 0;
                const duration = 1000;
                const increment = finalValue / (duration / 16);

                function updateNumber() {
                    startValue += increment;
                    if (startValue < finalValue) {
                        number.textContent = Math.floor(startValue);
                        requestAnimationFrame(updateNumber);
                    } else {
                        number.textContent = finalValue;
                    }
                }

                updateNumber();
            });
        });
    </script>

    <!-- Booking analytics -->
    <script src="/Alumni-CvSU/admin/script/business_overview.js"></script>

    <!-- Booking trends and revenue -->
    <script type="module" src="/Alumni-CvSU/admin/script/booking_performance.js"></script>

    <script type="module" src="/Alumni-CvSU/admin/script/essentials.js"></script>

    <script src="/Alumni-CvSU/admin/script/dashboard.js"></script>

    <script src="/Alumni-CvSU/admin/script/generate_report.js"></script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const yearFilter = document.getElementById("yearFilter");
            const monthFilter = document.getElementById("monthFilter");
            const userTypeFilter = document.getElementById("userTypeFilter");
            const roomFilter = document.getElementById("roomFilter");


            function populateYears() {
                const currentYear = new Date().getFullYear();
                const startYear = 2024; // Adjust this if needed

                yearFilter.innerHTML = ""; // Clear existing options
                let allYearsOption = document.createElement("option");
                allYearsOption.value = "";
                allYearsOption.text = "All Years";
                yearFilter.appendChild(allYearsOption); // Add "All Years"

                for (let year = currentYear; year >= startYear; year--) {
                    let option = document.createElement("option");
                    option.value = year;
                    option.text = year;
                    yearFilter.appendChild(option);
                }

                yearFilter.value = currentYear; // ✅ Default to current year
            }

            function updateMonths() {
                const selectedYear = yearFilter.value; // Get selected year
                const currentYear = new Date().getFullYear();
                const currentMonth = new Date().getMonth() + 1;

                monthFilter.innerHTML = ""; // Clear previous months

                // Add "All Months" option
                let allMonthsOption = document.createElement("option");
                allMonthsOption.value = "";
                allMonthsOption.text = "All Months";
                monthFilter.appendChild(allMonthsOption);

                for (let i = 1; i <= 12; i++) {
                    // If a specific year is selected and it's the current year, prevent future months
                    if (selectedYear !== "" && parseInt(selectedYear) === currentYear && i > currentMonth) {
                        break;
                    }

                    let option = document.createElement("option");
                    option.value = i;
                    option.text = new Date(0, i - 1).toLocaleString("default", {
                        month: "long"
                    });

                    monthFilter.appendChild(option);
                }

                // ✅ Always select "All Months" by default
                monthFilter.value = "";
            }


            function populateUserTypes() {
                fetch('/Alumni-CvSU/admin/analytics/get_user_types.php')
                    .then(response => response.json())
                    .then(data => {
                        const userTypeFilter = document.getElementById("userTypeFilter");
                        userTypeFilter.innerHTML = "<option value=''>All</option>"; // Default "All" option

                        data.forEach(user => {
                            let option = document.createElement("option");
                            option.value = user.user_status;
                            option.text = user.user_status;
                            userTypeFilter.appendChild(option);
                        });
                    })
                    .catch(error => console.error("Error fetching user types:", error));
            }

            // Call the function on page load
            document.addEventListener("DOMContentLoaded", populateUserTypes);



            function populateRooms() {
                // Define room name mapping (same as in PHP)
                const roomNames = {
                    '9': 'Board Room',
                    '10': 'Conference Room',
                    '11': 'Lobby'
                };

                // Function to get room display name
                function getRoomDisplay(roomNumber) {
                    if (roomNames[roomNumber]) {
                        return roomNames[roomNumber];
                    } else {
                        return "Room " + roomNumber;
                    }
                }

                fetch('/Alumni-CvSU/admin/analytics/get_room_number.php')
                    .then(response => response.json())
                    .then(data => {
                        roomFilter.innerHTML = "<option value=''>All Rooms</option>"; // Add "All Rooms"

                        data.forEach(room => {
                            let option = document.createElement("option");
                            option.value = room.room_number;
                            option.text = getRoomDisplay(room.room_number);
                            roomFilter.appendChild(option);
                        });
                    })
                    .catch(error => console.error("Error fetching rooms:", error));
            }


            // Initialize filters
            populateYears();
            updateMonths();
            populateUserTypes();
            populateRooms();

            // Update months when year changes
            yearFilter.addEventListener("change", updateMonths);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set up Select All / Deselect All buttons
            document.getElementById('selectAllCharts').addEventListener('click', function() {
                document.querySelectorAll('.report-checkbox').forEach(checkbox => {
                    checkbox.checked = true;
                });
            });

            document.getElementById('deselectAllCharts').addEventListener('click', function() {
                document.querySelectorAll('.report-checkbox').forEach(checkbox => {
                    checkbox.checked = false;
                });
            });
        });
    </script>
    <script>
        document.getElementById("resetFilters").addEventListener("click", function() {
            // Reset all filter dropdowns to default (assuming first option is default)
            document.querySelectorAll(".filter-select").forEach(select => {
                if (select.id === "yearFilter") {
                    select.selectedIndex = 1;
                } else {
                    select.selectedIndex = 0;
                }
            });


            // Reset all toggles
            document.querySelectorAll(".toggle-input").forEach(toggle => {
                toggle.checked = true;
            });

            // Reset all checkboxes
            document.querySelectorAll(".report-checkbox-container input[type='checkbox']").forEach(checkbox => {
                checkbox.checked = true;
            });

            updateChart();
        });
    </script>

</body>

</html>