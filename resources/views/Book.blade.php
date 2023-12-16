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
            background-color: rgba(144, 238, 144, 0.478);
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
            background: rgba(144, 238, 144, 0.478);
        }

        #tableDiv {
            height: 600px;
            overflow: hidden;
            overflow-y: scroll;
            flex: 1;
            padding: 5px;
            padding-top: 0;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        #tableDiv::-webkit-scrollbar {
            display: none;
        }

        h1 {
            margin: 0;
            color: rgb(17, 61, 17);
        }

        [id^="books"] {
            background: white;
            padding: 10px;
            border-radius: 20px;
            flex: 0 0 30%;
            display: flex;
            flex-direction: column;
            transition: opacity 0.3s;
        }

        [id^="books"].hide{
            opacity: 0;
        }

        p {
            margin: 5px;
        }

        span {
            color: grey;
        }

        .titles{
            font-weight: bold;
            text-align: center;
            background: rgb(81, 81, 81);
            padding: 5px;
            color: rgb(251, 251, 218);
            border-radius: 10px;
        }

        #descriptions {
            display:flex;
            flex-direction: row;
        }

        #addButton {
            border: none;
            background: cyan;
            padding: 5px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        #addButton:hover {
            cursor: pointer;
        }

        #addButton:active {
            background: white;
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

        input,select{
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

        #edits {
            display: flex;
            gap: 10px;
            margin-top: auto;
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

        .update {
            background: rgba(144, 238, 144, 0.478);
        }

        .delete {
            background: rgba(255, 192, 203, 0.304);
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
        <h1>Books</h1>
        <button id="addButton">add book</button>
        <div id="tableDiv">

            <?php foreach ($books as $book): ?>
                <div id="books{{$book->id}}">
                    <p class="titles">{{$book->title}}</p>
                    <p class="authors"><span>Author: </span>{{$book->author}}</p>
                    <p class="genres"><span>Genre: </span>{{$book->genre}}</p>
                    <p class="dates"><span>Publish Date: </span>{{$book->publish_date}}</p>
                    <p class="status"><span>status: </span>{{$book->status}}</p>
                    <div id="edits">
                        <button class="update" onclick="updateBook({{$book->id}})">update</button>
                        <button type="button" class="delete" onclick="deleteBook({{$book->id}})">delete</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div id="myModal" class="myModal">
        <div id="myForm">
            <form action="{{url('/books/add')}}" method="POST" id="bookForm">
                <span class="closeAdd">&times;</span>
                <h2 id="formLabel">Add a book</h2>
                @csrf
                <label for="title">Title</label>
                <input type="text" id="title" name="title" placeholder="Enter Title" required>
                <label for="author">Author</label>
                <input type="text" id="author" name="author" placeholder="Enter Author" required>
                <label for="genre">Genre</label>
                <input type="text" id="genre" name="genre" placeholder="Enter Genre" required>
                <label for="publish_date">Publish Date</label>
                <input type="date" id="publish_date" name="publish_date" required>
                <label for="status">Status</label>
                <select name="status" id="status">
                    <option value="available">Available</option>
                    <option value="unavailable">Unavailable </option>
                </select>
                <button type="submit" class="submit">submit</button>
            </form>
        </div>
    </div>

    <div id="updateModal" class="updateModal">
        <div id="myForm">
            <form action="" id="bookForm">
                <span class="closeUpdate">&times;</span>
                <h2 id="formLabel">Update</h2>
                @csrf
                <label for="title">Title</label>
                <input type="text" id="updateTitle" name="title" placeholder="Enter Title" value="{{$book->title}}" required>
                <label for="author">Author</label>
                <input type="text" id="updateAuthor" name="author" placeholder="Enter Author" required>
                <label for="genre">Genre</label>
                <input type="text" id="updateGenre" name="genre" placeholder="Enter Genre" required>
                <label for="publish_date">Publish Date</label>
                <input type="date" id="updatePublish_date" name="publish_date" required>
                <label for="status">Status</label>
                <select name="status" id="updateStatus">
                    <option value="available">Available</option>
                    <option value="unavailable">Unavailable </option>
                </select>
                <button type="button" class="submit" id="submitbtn" onclick="submitUpdate()">submit</button>
            </form>
        </div>
    </div>

    <script>
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

        function updateBook(bookId) {

            fetch(`/books/${bookId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('updateTitle').value = data.title;
                    document.getElementById('updateAuthor').value = data.author;
                    document.getElementById('updateGenre').value = data.genre;
                    document.getElementById('updatePublish_date').value = data.publish_date;
                    document.getElementById('updateStatus').value = data.status;
                    document.getElementById('submitbtn').setAttribute('data-id', data.id);
                    updateModal.style.display = "block";
                })
        }

        function submitUpdate() {
            var bookId = document.getElementById('submitbtn').getAttribute('data-id');

            fetch(`/books/update/${bookId}`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    title: document.getElementById('updateTitle').value,
                    author: document.getElementById('updateAuthor').value,
                    genre: document.getElementById('updateGenre').value,
                    publish_date: document.getElementById('updatePublish_date').value,
                    status: document.getElementById('updateStatus').value,
                })
            }).then(response => {
                var bookDiv = document.getElementById("books" + bookId);
                updateModal.style.display = "none";
                bookDiv.style.animation = "fadeIn 1s forwards";
                setTimeout(function() {
                    location.reload();
                }, 1000);
            });
        }

        function deleteBook(bookId) {
            var bookDiv = document.getElementById("books" + bookId);

            if (bookDiv) {
                if (confirm('Are you sure you want to delete this book?')) {
                    bookDiv.classList.add("hide");

                    setTimeout(() => {
                    fetch(`/books/${bookId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                    }).then(response => {
                        if (response.ok) {
                            bookDiv.remove();
                        } else {
                            console.error('Failed to delete book.');
                            bookDiv.classList.remove("hide");
                        }
                    })}, 500);
                }
            }
        }
    </script>
</body>
</html>
