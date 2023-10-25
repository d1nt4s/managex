<?php require ( VIEWS .'/incs/header.php'); ?>

<main class="main py-3">
<div class="card" style="width: 700px; height: 350px; margin-left: 20px;">
  <div class="card-body">

    <div class="pomodoro">
      <!-- в h1 важно вставить значение или из Куки или базовые через pomodoro.php -->
      <h1 id="timer">45:00</h1>
      <button type='button' onclick="" id='start'>Start</button>
      <button type='button' onclick="" id='pause' style="display:none;">Pause</button>

      <br>

      <span class="pomodoro-feature-name">Session</span>
      <input type="number" min="1" step="1" width="70" class="pomodoro-feature" value="<?= $stages['session'] ?>">

      <br>

      <span class="pomodoro-feature-name">Short Break</span>
      <input type="number" min="1" step="1" width="70" class="pomodoro-feature" value="<?= $stages['short_break'] ?>">

      <br>

      <span class="pomodoro-feature-name">Long Break</span>
      <input type="number" min="1" step="1" width="70" class="pomodoro-feature" value="<?= $stages['long_break'] ?>">

      <br>

      <span class="pomodoro-feature-name">Long Break interval</span>
      <input type="number" min="1" step="1" width="70" class="pomodoro-feature" value="<?= $stages['long_break_interval'] ?>">

      <br>

      <button type="button" onclick="" id='set'>Set</button>

    </div>

  </div>
</div>

<script type="module" src="scripts/pomodoro.js"></script>

</main>

<?php require(VIEWS . '/incs/footer.php'); ?>
