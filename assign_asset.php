<?php
include('Connection.php');
include('templates/header.php');

if (isset($_POST['assign_asset'])) {
    // Sanitize and collect form data
    $asset_id = $_POST['asset_id'];
    $full_name = $_POST['full_name'];
    $employee_id = $_POST['employee_id'];
    $mobile_number = $_POST['mobile_number'];
    $email_id = $_POST['email_id'];
    $department = $_POST['department'];
    $designation = $_POST['designation'];
    $joining_date = $_POST['joining_date'];
    $residence_location = $_POST['residence_location'];
    $gender = $_POST['gender'];
    $pan_number = $_POST['pan_number'];

    // SQL query to insert data into the table (replace `asset_assignments` with your table name)
    $query = "INSERT INTO asset_assignments (asset_id, full_name, employee_id, mobile_number, email_id, department, designation, joining_date, residence_location, gender, pan_number)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare and execute the statement
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param('issssssssss', $asset_id, $full_name, $employee_id, $mobile_number, $email_id, $department, $designation, $joining_date, $residence_location, $gender, $pan_number);
        if ($stmt->execute()) {
            echo "<p>Asset assigned successfully!</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }
        $stmt->close();
    } else {
        echo "<p>Error: " . $con->error . "</p>";
    }
}

?>
<br>
<h2 style="text-align: center;">Assign Asset</h2>

<!-- Existing HTML and JavaScript code -->
<?php
include('templates/footer.php');
?>


<!-- Autocomplete Search Form -->
<form id="searchForm" method="post">
    <label>Search Asset by Serial Number:</label>
    <input type="text" id="searchInput" name="search_serial" placeholder="Enter Serial Number" autocomplete="off">
    <input type="hidden" id="selectedAssetId" name="asset_id">
    <input type="button" value="Assign Asset" onclick="openPopup();">
</form>

<!-- Autocomplete Results -->
<div id="autocomplete-results" style="position: absolute; z-index: 1000; border: 1px solid #ddd; display: none;"></div>

<!-- Popup Form -->
<div id="popupForm" class="popup" style="display:none;">
    <div class="popup-content">
        <h3>Assign Asset Form</h3>
        <br>
        <form id="popupAssignForm" action="assign_asset.php" method="post">
            <input type="hidden" name="asset_id" id="popupAssetId" value="">

            <label>Full Name:</label>
            <input type="text" name="full_name" required><br>

            <label>Employee ID:</label>
            <input type="text" name="employee_id" required><br>

            <label>Mobile Number:</label>
            <input type="tel" name="mobile_number" pattern="[0-9]{10}" required><br>

            <label>Email Id:</label>
            <input type="email" name="email_id" required><br>

            <label>Department:</label>
            <input type="text" name="department" required><br>

            <label>Designation:</label>
            <input type="text" name="designation" required><br>

            <label>Date Of Joining:</label>
            <input type="date" name="joining_date" required><br>

            <label>Residence Location:</label>
            <input type="text" name="residence_location"><br>

            <label>Gender:</label>
            <select name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select><br>

            <label>PAN Number:</label>
            <input type="text" name="pan_number"><br>

            <input type="submit" name="assign_asset" value="Assign"><br>
            <button type="button" onclick="closePopup();">Close</button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('searchInput');
    var autocompleteResults = document.getElementById('autocomplete-results');

    searchInput.addEventListener('input', function() {
        var query = searchInput.value;

        if (query.length > 0) {
            fetch('autocomplete.php?term=' + encodeURIComponent(query))
                .then(response => response.json())
                .then(data => {
                    autocompleteResults.innerHTML = '';
                    if (data.length) {
                        data.forEach(item => {
                            var div = document.createElement('div');
                            div.textContent = item.label;
                            div.dataset.id = item.value;
                            div.style.padding = '10px';
                            div.style.cursor = 'pointer';
                            div.addEventListener('click', function() {
                                searchInput.value = item.label;
                                document.getElementById('selectedAssetId').value = item.value;
                                autocompleteResults.style.display = 'none';
                            });
                            autocompleteResults.appendChild(div);
                        });
                        autocompleteResults.style.display = 'block';
                    } else {
                        autocompleteResults.style.display = 'none';
                    }
                });
        } else {
            autocompleteResults.style.display = 'none';
        }
    });

    document.addEventListener('click', function(event) {
        if (!autocompleteResults.contains(event.target) && event.target !== searchInput) {
            autocompleteResults.style.display = 'none';
        }
    });
});

function openPopup() {
    document.getElementById('popupForm').style.display = 'block';
}

function closePopup() {
    document.getElementById('popupForm').style.display = 'none';
}

// Close popup if clicked outside of it
window.onclick = function(event) {
    if (event.target.classList.contains('popup')) {
        closePopup();
    }
}
</script>

<style>
/* Popup styling */
.popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
}

.popup-content {
    background-color: white;
    padding: 15px; /* Reduced padding */
    border-radius: 5px;
    width: 90%; /* Adjust width to fit more content */
    max-width: 400px; /* Reduced max width */
    max-height: 80vh; /* Set max height to 80% of the viewport height */
    overflow-y: auto; /* Make content scrollable if it exceeds max height */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
    margin-left: auto;
    margin-right: auto; /* Center the popup horizontally */
    transform: translate(0, 0);
}

/* Autocomplete styling */
#autocomplete-results div {
    border-bottom: 1px solid #ddd;
}

#autocomplete-results div:hover {
    background-color: #f0f0f0;
}

/* Button Styling */
.assign-btn {
    background-color: #007bff;
    color: white;
    border: none;
    width: 100%; /* Set width to 100% for better alignment */
    border-radius: 4px;
    padding: 8px 0; /* Adjust padding to be more compact */
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.assign-btn:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}

.assign-btn:active {
    background-color: #004494;
    transform: scale(0.98);
}

/* Adjust form fields */
#popupAssignForm input[type="text"],
#popupAssignForm input[type="email"],
#popupAssignForm input[type="date"],
#popupAssignForm input[type="tel"],
#popupAssignForm select {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    box-sizing: border-box;
}
</style>

<?php
include('templates/footer.php');
?>