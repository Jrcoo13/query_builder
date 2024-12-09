<?php
session_start();
?>
<script>
        function getStudentData() {
            fetch('get_data.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    const tableBody = document.querySelector('#studentTable tbody');
                    const resultsContainer = document.getElementById('resultsContainer');

                    resultsContainer.style.display = 'block';
                    // Clear previous data
                    tableBody.innerHTML = '';

                    // Populate table with new data
                    data.forEach(student => {
                        const row = tableBody.insertRow();
                        row.insertCell(0).textContent = student.id;
                        row.insertCell(1).textContent = student.id_number;
                        row.insertCell(2).textContent = student.student_name;
                        row.insertCell(3).textContent = student.degree_program;
                        row.insertCell(4).textContent = student.year_level;
                        row.insertCell(5).textContent = student.join_date;
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        document.getElementById('viewStudent').addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('query-error').textContent = '';
            document.getElementById('query-message').style.display = 'none';
            document.querySelector('.custom-query-error').style.display = 'none';
            // Load the table
            getStudentData();
        });

        document.getElementById('queryForm').addEventListener('submit', (e) => {
            const query = document.getElementById('query').value;
            const queryError = document.getElementById('query-error');

            // Check if the query is empty
            if (query.trim().length === 0) {
                // Prevent the form from submitting
                e.preventDefault();

                // Display custom error message
                queryError.textContent = 'Error: The query cannot be empty.';
                document.querySelector('.custom-query-error').style.display = 'block';
                document.getElementById('resultsContainer').style.display = 'none';
                document.getElementById('query-message').style.display = 'none';
            } else {
                // Clear previous error message
                queryError.textContent = '';
                document.querySelector('.custom-query-error').style.display = 'block';
            }
        });

        // Restore textarea value after form submission or refresh
        document.addEventListener('DOMContentLoaded', () => {
            const queryValue = "<?php echo isset($_SESSION['query']) ? htmlspecialchars($_SESSION['query']) : ''; ?>";
            document.getElementById('query').value = queryValue;
        });
    </script>