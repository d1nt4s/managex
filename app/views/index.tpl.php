<?php require ( VIEWS .'/incs/header.php'); ?>

<main class="main py-3">
<div class="card" style="width: 700px; height: 350px; margin-left: 20px;">
  <div class="card-body">

    <div class="pomodoro">
      <!-- в h1 важно вставить значение или из Куки или базовые через pomodoro.php -->
      <h1 id="timer">45:00</h1>
      <button type='button' onclick="" id='start'>Start</button>
      <button type='button' onclick="" id='stop' style="display:none;">Stop</button>

      <br>

      <span class="pomodoro-feature-name">Session</span>
      <input type="number" min="1" step="1" width="70" class="pomodoro-feature" value="45">

      <br>

      <span class="pomodoro-feature-name">Short Break</span>
      <input type="number" min="1" step="1" width="70" class="pomodoro-feature" value="5">

      <br>

      <span class="pomodoro-feature-name">Long Break</span>
      <input type="number" min="1" step="1" width="70" class="pomodoro-feature" value="15">

      <br>

      <span class="pomodoro-feature-name">Long Break interval</span>
      <input type="number" min="1" step="1" width="70" class="pomodoro-feature" value="2">

      <br>

      <button type="button" onclick="" id='set'>Set</button>

    </div>

  </div>
</div>

<script type="module" src="scripts/pomodoro.js"></script>

</main>

<?php require(VIEWS . '/incs/footer.php'); ?>
