<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotsu Attendance Clone App</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

        body {
            font-family: Poppins, sans-serif;
            font-size: 0.75rem;
        }

        table,
        th,
        td {
            color: black;
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 0.75rem;
        }

        th,
        td {
            padding: 10px;
        }

        th {
            background-color: #ffffff;
        }

        textarea {
            height: 100px;
            width: 450px;
        }

        #resultsContainer {
            display: none;
        }

        #query-message {
            display: none;
        }

        .custom-query-error {
            display: none;
        }

        .copyrights {
            margin-top: 50px;
            color: grey;
            font-size: 12px;
        }
        /* MEDIA QUERIES */
        /* Styles for screens smaller than 600px */
        @media (max-width: 600px) {
            body {
                font-size: 0.7rem;
            }

            table {
                font-size: 0.7rem;
            }

            textarea {
            height: 100px;
            width: 350px;
            }

            th, td {
                padding: 5px;
            }

            .copyrights {
                font-size: 10px;
            }
        }

        /* Styles for screens between 600px and 900px */
        @media (min-width: 601px) and (max-width: 900px) {
            body {
                font-size: 0.75rem;
            }

            table {
                font-size: 0.75rem;
            }
        }

        /* Styles for screens larger than 900px */
        @media (min-width: 901px) {
            body {
                font-size: 0.75rem;
            }

            table {
                font-size: 0.75rem;
            }

            textarea {
                height: 100px;
                width: 450px;
            }
        }
    </style>
</head>

<body>
    <h1>Cotsu Attendance Clone App</h1>
    <form id="queryForm" action='query_controller.php'; method="POST">
        <label for="query">Enter your query here:</label>
        <br>
        <textarea name="query" id="query"></textarea>
        <br><br>
        <button type="submit" name="query_button" id="query_button">Execute query</button>
        <button type="button" id="viewStudent">View attendance</button>
    </form>
    <br>
    <h3>Table info:</h3>
    <p>student (<br>
        id_number INT,<br>
        name VARCHAR(100),<br>
        course VARCHAR(256),<br>
        year_level INT <br>
        );
    </p>

    <div id="query-message">
        <?php
        if (isset($_SESSION['notify_success'])) {
        ?>
            <p style="color:green;"><?php echo htmlspecialchars($_SESSION['notify_success']); ?></p>
            <script>
                document.getElementById('query-message').style.display = 'block';
                document.getElementById('query').textContent = '';
            </script>
        <?php
            unset($_SESSION['notify_success']);
        }
        if (isset($_SESSION['notify_error'])) {
        ?>
            <p style="color:red;"><?php echo htmlspecialchars($_SESSION['notify_error']); ?></p>
            <script>
                document.getElementById('query-message').style.display = 'block';
            </script>
        <?php
            unset($_SESSION['notify_error']);
        }
        ?>
    </div>

    <div class="custom-query-error">
        <!-- custom error message if the query is null -->
        <p style="color: red;" id="query-error"></p>
    </div>

    <div id="resultsContainer">
        <h2>Results:</h2>
        <table id="studentTable">
            <thead>
                <tr>
                    <th></th>
                    <th>Student id</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Year Level</th>
                    <th>Join Date</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <footer>
        <p class='copyrights'>&copy; Created by Jrco Ocl 2024</p>
    </footer>
    <?php
    include('index_controller.php');
    ?>
</body>
</html>
