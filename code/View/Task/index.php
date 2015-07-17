<p>
    <b>#<?php echo $this->_pars['task']['task_id']; ?></b> Создал: <?php echo $this->_pars['task']['cuser']; ?> <span class="label label-info"><?php echo date_format(new DateTime($this->_pars['task']['task_create_time']), 'd.m.Y в H:i'); ?></span>
</p>
<p>
    Исполнитель: <b><?php echo $this->_pars['task']['user']; ?></b>
</p>
<br />
<p><?php echo nl2br($this->_pars['task']['task_text']) ?></p>
<br />
<p>
    Срочность: <b><?php echo $this->_pars['task']['urg']; ?></b> &nbsp;&nbsp;|&nbsp;&nbsp; Сложность: <b><?php echo $this->_pars['task']['comp']; ?></b>
</p>

<br />
<?php
$taskStatus = array(
    1 => 'success',
    2 => 'info',
    3 => 'important'
);
?>
Статус: &nbsp;<span id="statusinfo" class="label label-<?php echo $taskStatus[$this->_pars['task']['status_id']]; ?>"><?php echo $this->_pars['task']['status']; ?></span>
<i id="statuseditp" class="icol-pencil"></i>
<div id="statuseditb" class="hide">
    <select id="statusids">
        <option<?php if ($this->_pars['task']['status_id'] == 1): ?> selected="selected"<?php endif; ?> value="1">Новая</option>
        <option<?php if ($this->_pars['task']['status_id'] == 2): ?> selected="selected"<?php endif; ?> value="2">Выполняется</option>
        <option<?php if ($this->_pars['task']['status_id'] == 3): ?> selected="selected"<?php endif; ?> value="3">Закрыта</option>
    </select>
    <button taskid="<?php echo $this->_pars['task']['task_id']; ?>" id="statuseditbtn" class="btn btn-success" type="button">Сохранить</button>
</div>
<br />
<br />
<p><i class="icol-envelope"></i> Комментарии:</p>
<hr />
<div id="task_comments">
    <?php foreach ($this->_pars['task_comments'] as $_c): ?>
    <p><b><?php echo $_c['user']; ?></b> <?php echo date_format(new DateTime($_c['create_time']), 'd.m.Y в H:i'); ?></p>
    <div class="well">
        <?php echo nl2br($_c['message']); ?>
    </div>
    <?php endforeach; ?>
</div>

<fieldset>
    <legend>Новый комментарий</legend>
    <div class="control-group">
        <textarea id="newcomment" rows="3" class="span4"></textarea>
        <span class="help-block hide"></span>
    </div>

    <button taskid="<?php echo $this->_pars['task']['task_id']; ?>" userid="<?php echo $_SESSION['user_id']; ?>" id="newcommentbtn" type="submit" class="btn">Добавить</button>
</fieldset>