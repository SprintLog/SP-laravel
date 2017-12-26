<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>JS Bin</title>
  <link rel="stylesheet" href="css/EJ-kanban.css">
</head>
<body>
  <div class="app-wrapper">
  <header class="header">
    <h1 class="logo">Kanban
      <small>by Elton Jain</small>
    </h1>
    <p class="total-card-counter" id="totalCards"></p>
  </header>
  <form id="frmAddTodo" class="form-add-todo">
    Add Project:
    <input type="text" autocomplete="off" name="todo_text" id="" value="" placeholder="Write and press enter" />
  </form>
  <div class="board" id="board"></div>
  <form id="frmAddList" class="form-add-list">
    Add List:
    <input type="text" autocomplete="off" name="list_name" id="" value="" placeholder="List name" />
  </form>
  </div>

<script src="https://cdn.jsdelivr.net/lodash/4/lodash.min.js"></script>
<script src="js/EJ-kanban"></script>



</body>
</html>
