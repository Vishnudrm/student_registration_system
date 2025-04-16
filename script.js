// Display popup on successful deletion
function showDeletePopup(studentName, studentId) {
    const popup = document.createElement('div');
    popup.classList.add('modal');
    
    popup.innerHTML = `
        <div class="modal-content">
            <h2>Success!</h2>
            <p>The student ${studentName} with ID: ${studentId} has been deleted.</p>
            <div class="modal-buttons">
                <button id="confirmDelete" class="modal-btn" onclick="closePopup()">OK</button>
            </div>
        </div>
    `;
    
    document.body.appendChild(popup);
    popup.style.display = 'flex';
}

// Close popup when clicking OK
function closePopup() {
    const popup = document.querySelector('.modal');
    popup.style.display = 'none';
    document.body.removeChild(popup);
}

// Handle form submission for registration
document.querySelector('.registration-form')?.addEventListener('submit', function(e) {
    e.preventDefault();

    // Display success message after registration
    alert("Student registered successfully!");
});

// Handle form submission for deletion
document.querySelector('.delete-form')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const studentId = document.querySelector('input[name="student_id"]').value;
    const studentName = document.querySelector('input[name="student_name"]').value;

    // Assuming deletion is successful, show the popup
    showDeletePopup(studentName, studentId);  // Replace 'Student Name' with the actual name from your database
});

// Function to handle student deletion
function deleteStudent(studentName, studentId) {
    if (confirm(`Are you sure you want to delete the student ${studentName} with ID: ${studentId}?`)) {
        // Simulate successful deletion (You should trigger the backend delete process here)
        showDeletePopup(studentName, studentId);
    }
}
