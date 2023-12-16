<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <style>
        body{
            display: flex;
            flex-direction: row;
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: rgba(250, 250, 210, 0.741);
        }

        nav {
            display: flex;
            flex-direction: column;
            padding: 50px;
            background: white;
            flex: 1;
            border-radius: 20px;
            box-shadow: 0 0 2px;
        }

        #navigation {
            width: 20%;
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
        }

        #contents {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
        }

        a {
            text-decoration: none;
            color: black;
            font-size: 25px;
            margin: 10px;
            padding: 50px 10px;
            box-shadow: 0 0 2px;
            border-radius: 5px;
            text-align: center;
        }

        a:hover {
            background: rgba(250, 250, 210, 0.741);
        }

        #tableDiv {
            height: 600px;
            overflow: hidden;
            overflow-y: scroll;
            flex: 1;
            padding: 5px;
            padding-top: 0;

        }

        #tableDiv::-webkit-scrollbar {
            display: none;
        }

        table {
            border-collapse: separate;
            border-spacing: 0 10px;
            width: 100%;
        }

        thead tr {
            top: 0;
            position: sticky;
            background: rgb(217, 217, 217);
        }

        [id^="students"] {
            transition: opacity 0.3s;
        }

        [id^="students"].hide{
            opacity: 0;
        }

        th {
            padding: 5px;
        }

        td {
            border: none;
            padding: 20px;
        }

        td:first-child {
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
        }

        td:last-child {
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        tr:not(thead tr) {
            background: white;
        }

        h1 {
            margin: 0;
            color: rgb(52, 52, 23);
        }

        #buttons {
            display: flex;
            justify-content: center;
            gap: 5px;
        }

        .update, .delete {
            flex: 1;
            border: none;
            padding: 5px;
            border-radius: 10px;
        }

        .update:hover, .delete:hover {
            cursor: pointer;
        }

        .delete {
            background: rgba(255, 192, 203, 0.304);
        }

        .update {
            background: rgb(120, 255, 255);
        }

        .myModal, .updateModal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }

        .closeAdd, .closeUpdate {
            color: #aaaaaa;
            width: 20px;
            margin-left: auto;
            font-size: 28px;
            font-weight: bold;
        }

        .closeAdd:hover, .closeAdd:focus, .closeUpdate:hover, .closeUpdate:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        #myForm {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
        }

        form {
            display: flex;
            flex-direction: column;
            background: white;
            box-shadow: 0 0 2px;
            padding: 20px;
            border-radius: 20px;
        }

        input{
            margin-bottom: 20px;
        }

        .submit {
            background: rgba(144, 238, 144, 0.478);
            border: none;
            border-radius: 10px;
            padding: 10px;
        }

        .submit:hover {
            cursor: pointer;
        }

        input, select{
            padding: 10px;
            background: rgba(211, 211, 211, 0.503);
            border: none;
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            margin: 0;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                background: rgba(0, 255, 255, 0.293);
            }
            to {
                opacity: 1;
                background: white;
            }
        }

        #addButton {
            border: none;
            background: rgb(120, 255, 255);
            padding: 5px;
            border-radius: 5px;
        }

        #addButton:hover {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="navigation">
        <nav>
            <a href=" {{ url('/') }} ">Home</a>
            <a href="{{ url('/books') }}">Books</a>
            <a href=" {{ url('/checkouts') }} ">Checkouts</a>
            <a href=" {{ url('/students') }} ">Students</a>
        </nav>
    </div>

    <div id="contents">
        <h1>Students</h1>
        <button id="addButton">Add Student</button>
        <div id="tableDiv">
            <table>
                <thead class="table-1">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Edit</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr id="students{{$student->id}}">
                            <td>{{$student->name}}</td>
                            <td>{{$student->email}}</td>
                            <td>{{$student->phone}}</td>
                            <td>
                                <div id="buttons">
                                    <button type="button" class="update" onclick="updateStudent({{$student->id}})">Update</button>
                                    <button type="button" class="delete" onclick="deleteStudent({{$student->id}})">Delete</button>
                                </div>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="myModal" class="myModal">
        <div id="myForm">
            <form action="{{url('/students/add')}}" method="POST" id="studentForm">
                <span class="closeAdd">&times;</span>
                <h2 id="formLabel">Add a student</h2>
                @csrf
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Enter student name" required>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter email" required>
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" placeholder="Enter mobile number" required>
                <button type="submit" class="submit">submit</button>
            </form>
        </div>
    </div>

    <div id="updateModal" class="updateModal">
        <div id="myForm">
            <form action="" id="studentForm">
                <span class="closeUpdate">&times;</span>
                <h2 id="formLabel">Update Student</h2>
                @csrf
                <label for="name">Name</label>
                <input type="text" id="updateName" name="name" placeholder="Enter student name" required>
                <label for="email">Email</label>
                <input type="email" id="updateEmail" name="email" placeholder="Enter email" required>
                <label for="phone">Phone</label>
                <input type="text" id="updatePhone" name="phone" placeholder="Enter Phone" required>
                <button type="button" class="submit" id="submitbtn" onclick="submitUpdate()">submit</button>
            </form>
        </div>
    </div>

    <script>
        function deleteStudent(studentId) {
            var studentDiv = document.getElementById("students" + studentId);

            if (studentDiv) {
                if (confirm('Are you sure you want to delete this Student?')) {
                    studentDiv.classList.add("hide");

                    setTimeout(() => {
                    fetch(`/students/${studentId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                    }).then(response => {
                        if (response.ok) {
                            studentDiv.remove();
                        } else {
                            console.error('Failed to delete checkout.');
                            studentDiv.classList.remove("hide");
                        }
                    })}, 500);
                }
            }
        }

        var modal = document.getElementById("myModal");
        var updateModal = document.getElementById("updateModal");
        var btn = document.getElementById("addButton");
        var span = document.getElementsByClassName("closeAdd")[0];
        var updatespan = document.getElementsByClassName("closeUpdate")[0];

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        updatespan.onclick = function() {
            updateModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }else if (event.target == updateModal){
                updateModal.style.display = "none";
            }
        }

        function updateStudent(studentId) {

            fetch(`/students/${studentId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('updateName').value = data.name;
                    document.getElementById('updateEmail').value = data.email;
                    document.getElementById('updatePhone').value = data.phone;
                    document.getElementById('submitbtn').setAttribute('data-id', data.id);
                    updateModal.style.display = "block";
                })
        }

        function submitUpdate() {
            var studentId = document.getElementById('submitbtn').getAttribute('data-id');

            fetch(`/students/update/${studentId}`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    name: document.getElementById('updateName').value,
                    email: document.getElementById('updateEmail').value,
                    phone: document.getElementById('updatePhone').value,
                })
            }).then(response => {
                var studentDiv = document.getElementById("students" + studentId);
                updateModal.style.display = "none";
                studentDiv.style.animation = "fadeIn 1s forwards";
                setTimeout(function() {
                    location.reload();
                }, 1000);
            });
        }
    </script>
</body>
</html>
