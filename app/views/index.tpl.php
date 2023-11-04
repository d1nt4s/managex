<?php require ( VIEWS .'/incs/header.php'); ?>

<main class="main py-3">

<div class="card" style="width: 700px; height: 350px; margin-left: 20px;">
  <div class="card-body">
    <div class="pomodoro">
      <!-- в h1 важно вставить значение или из Куки или базовые через pomodoro.php -->
      <h3 id='stage'></h3>
      <h1 id="timer">45:00</h1>
      <button type='button' onclick="" id='start_pomodoro'>Start</button>
      <button type='button' onclick="" id='pause_pomodoro' style="display:none;">Pause</button>

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

      <button type="button" onclick="" id='set_pomodoro'>Set</button>

      <br>

      <h4>Completed Session's</h4>
      <p id='compl_sess'>0</p>

    </div>
  </div>
</div>

<?php 
  $timetable = $GLOBALS['timetable'];
  $days_week = $GLOBALS['days_week'];
?>

<div>
  <div class="timenetto">

    <div class="switch-btn switch-on"></div>

    <table class="table timelog" style="display: block">
      <thead>
        <tr>
          <?php foreach ($days_week as $day) : ?>

            <th scope="col" colspan="2"><?= $day ?></th>

            <?php $output = showDayLog($day); ?>

            <?php foreach ($output as $line) : ?>
              <tr><td class=""><?= $line ?></td></tr>
            <?php endforeach; ?>

          <?php endforeach; ?>
        </tr>
      </thead>
    </table>

    <table class="table time_analyze" style="display: none">
      <thead>
        <tr>
          <?php foreach ($days_week as $day) : ?>

            <th scope="col" colspan="2"><?= $day ?></th>

            <?php $output = analyzeDay($day);?>

            <?php foreach ($output as $line) : ?>
              <tr><td class=""><?= $line ?></td></tr>
            <?php endforeach; ?>

          <?php endforeach; ?>
        </tr>
      </thead>
    </table>

  </div>
</div>

<div>
  <div class="timetable">

  <table class="table table-dark table-striped align-middle table-sm">
    <thead>
      <tr>
        <?php foreach ($days_week as $day) : ?>
          <th scope="col" colspan="2"><?= $day ?></th>
        <?php endforeach; ?>
      </tr>
    </thead>
    <tbody class="timetable-body">

      <?php $businesses = ['skip this','first', 'second', 'third', 'fourth', 'fifth', 'sixth']; ?>
      <?php for ($count = 1; $count <= $timetable[lcfirst($day)]['count_business']; $count++) : ?>
        <tr>
          <?php foreach ($days_week as $day) : ?>
            <td class="action <?= lcfirst($day) ?> row<?=$count?>"><textarea rows="1"><?= $timetable[lcfirst($day)]["{$businesses[$count]}_business_name"] ?></textarea></td>
            <td class="duration <?= lcfirst($day) ?> row<?=$count?>"><input type="number" value="<?= $timetable[lcfirst($day)]["{$businesses[$count]}_business_lasting"] ?>"></td>
          <?php endforeach; ?>
        </tr>
      <?php endfor; ?>

      <tr>
        <?php foreach ($days_week as $day) : ?>
          <td class="text">Working day until: </td>
          <td class="duration time <?= lcfirst($day) ?> row7"><input value="<?= $timetable[lcfirst($day)]['finish_time'] ?>"></td>
        <?php endforeach; ?>
      </tr>
      <tr>
        <?php foreach ($days_week as $day) : ?>
          <td class="text">Working day duration: </td>
          <td class="duration day <?= lcfirst($day) ?> row8"><input value="<?= $timetable[lcfirst($day)]['day_lasting'] ?>"></td>
        <?php endforeach; ?>
      </tr> 

    </tbody>
  </table>

  <button type="button" onclick="" id='set_timetable'>Set</button>
  <button type="button" onclick="" id='clear_timetable'>Clear</button>

  </div>
</div>


<script type="module" src="scripts/pomodoro.js"></script>
<script type="text/javascript" src="scripts/timetable.js"></script>
<script type="text/javascript" src="scripts/timenetto.js"></script>

</main>

<?php require(VIEWS . '/incs/footer.php'); ?>
