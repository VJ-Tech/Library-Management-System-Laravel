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
            background-color: rgba(255, 192, 203, 0.374);
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
            background: rgba(255, 192, 203, 0.374);
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
            color: rgb(67, 29, 35);
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

        input, select{
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

        [id^="checkouts"] {
            transition: opacity 0.3s;
        }

        [id^="checkouts"].hide{
            opacity: 0;
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
        <h1>Checkouts</h1>
        <button type="button" id="addButton">Add Checkout</button>
        <div id="tableDiv">
            <table>
                <thead class="table-1">
                    <tr>
                        <th>Student</th>
                        <th>Book</th>
                        <th>Checkout Date</th>
                        <th>Return Date</th>
                        <th>Status</th>
                        <th>Edit</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($checkouts as $checkout): ?>
                        <tr id="checkouts{{$checkout->id}}">
                            <td>{{$checkout->student->name}}</td>
                            <td>{{$checkout->book->title}}</td>
                            <td>{{$checkout->checkout_date}}</td>
                            <td>{{$checkout->return_date}}</td>
                            <td>{{$checkout->status}}</td>
                            <td>
                                <div id="buttons">
                                    <button type="button" class="update" id="update{{$checkout->id}}" onclick="openUpdate({{$checkout->id}}, {{$checkout->book->id}}, {{$checkout->student->id}})">Update</button>
                                    <button type="button" class="delete" onclick="deleteCheckout({{$checkout->id}})">Delete</button>
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
            <form action="{{url('/checkouts/add')}}" method="POST" id="checkoutForm">
                <span class="closeAdd">&times;</span>
                <h2 id="formLabel">Add Checkout</h2>
                @csrf
                <label for="student_id">Select Student</label>
                <select name="student_id" id="student_id" required>
                    <option hidden='true'>Select Student</option>
                    <option selected disabled>Select Student</option>
                    @foreach ($students as $studentId => $student)
                        <option value="{{$student->id}}">{{$student->name}}</option>
                    @endforeach
                </select>
                <label for="book_id">Select Book</label>
                <select name="book_id" id="book_id" required>
                    <option hidden='true'>Select Book</option>
                    <option selected disabled>Select Book</option>
                    @foreach ($books as $bookId => $book)
                        <option value="{{$book->id}}">{{$book->title}}</option>
                    @endforeach
                </select>
                <label for="checkout_date">Checkout Date</label>
                <input type="date" id="checkout_date" name="checkout_date" required>
                <label for="return_date">Return Date</label>
                <input type="date" id="return_date" name="return_date" required>
                <label for="status">Status</label>
                <select name="status" id="status">
                    <option value="accquired">accquired</option>
                    <option value="returned">returned</option>
                    <option value="overdue">overdue</option>
                    <option value="reserved">reserved</option>
                </select>
                <button type="submit" class="submit">submit</button>
            </form>
        </div>
    </div>

    <div id="updateModal" class="updateModal">
        <div id="myForm">
            <form action="" id="checkoutForm">
                <span class="closeUpdate">&times;</span>
                <h2 id="formLabel">Update Checkout</h2>
                @csrf
                <label for="student_id">Select Student</label>
                <select name="student_id" id="studentId" required>
                    <option hidden='true'>Select Student</option>
                    <option selected disabled>Select Student</option>
                    @foreach ($students as $studentId => $student)
                        <option value="{{$student->id}}">{{$student->name}}</option>
                    @endforeach
                </select>
                <label for="book_id">Select Book</label>
                <select name="book_id" id="bookId" required>
                    <option hidden='true'>Select Book</option>
                    <option selected disabled>Select Book</option>
                    @foreach ($books as $bookId => $book)
                        <option value="{{$book->id}}">{{$book->title}}</option>
                    @endforeach
                </select>
                <label for="checkout_date">Checkout Date</label>
                <input type="date" id="checkoutDate" name="checkout_date" required>
                <label for="return_date">Return Date</label>
                <input type="date" id="returnDate" name="return_date" required>
                <label for="status">Status</label>
                <select name="status" id="updateStatus">
                    <option value="accquired">accquired</option>
                    <option value="returned">returned</option>
                    <option value="overdue">overdue</option>
                    <option value="reserved">reserved</option>
                </select>
                <button type="button" class="submit" id="submitbtn" onclick="submitUpdate()">submit</button>
            </form>
        </div>
    </div>

    <script>
        function deleteCheckout(checkoutId) {
            var checkoutDiv = document.getElementById("checkouts" + checkoutId);

            if (checkoutDiv) {
                if (confirm('Are you sure you want to delete this Checkout?')) {
                    checkoutDiv.classList.add("hide");

                    setTimeout(() => {
                    fetch(`/checkouts/${checkoutId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                    }).then(response => {
                        if (response.ok) {
                            checkoutDiv.remove();
                        } else {
                            console.error('Failed to delete checkout.');
                            checkoutDiv.classList.remove("hide");
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

        function openUpdate(checkout, book, student) {

            fetch(`/checkouts/viewUpdate/${checkout}/${book}/${student}`)
                    .then(response => response.json())
                    .then(data => {
                console.log('Fetched data:', data);

                document.getElementById('studentId').value = data.students.id;
                document.getElementById('bookId').value = data.books.id;
                document.getElementById('checkoutDate').value = data.checkouts.checkout_date;
                document.getElementById('returnDate').value = data.checkouts.return_date;
                document.getElementById('updateStatus').value = data.checkouts.status;
                document.getElementById('submitbtn').setAttribute('data-id', data.checkouts.id);

                updateModal.style.display = "block";
            })
        }

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

        function submitUpdate() {

            var studentId = document.getElementById('studentId').value;
            var bookId = document.getElementById('bookId').value;
            var checkoutDate = document.getElementById('checkoutDate').value;
            var returnDate = document.getElementById('returnDate').value;
            var status = document.getElementById('updateStatus').value;

            var checkoutId = document.getElementById('submitbtn').dataset.id;

            var payload = {
                student_id: parseInt(studentId, 10),
                book_id: parseInt(bookId, 10),
                checkout_date: checkoutDate,
                return_date: returnDate,
                status: status,
            };

            fetch(`/checkouts/update/${checkoutId}`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(payload),
            }).then(response => {
                var checkoutDiv = document.getElementById("checkouts" + checkoutId);
                updateModal.style.display = "none";
                checkoutDiv.style.animation = "fadeIn 1s forwards";
                setTimeout(function () {
                    location.reload();
                }, 1000);
            });
        }
    </script>
</body>
</html>
