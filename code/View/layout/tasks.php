<div class="widget">
    <div class="widget-content table-container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Название</th>
                    <th>Дата создания</th>
                    <th>Срочность</th>
                    <th>Задачу поставил</th>
                    <th>Исполнитель</th>
                    <th>Статус</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $taskStatus = array(
                    1 => 'success',
                    2 => 'info',
                    3 => 'important'
                );
                ?>
                <?php foreach ($this->_pars['tasks'] as $_t): ?>
                <tr>
                    <td><?php echo $_t['task_id']; ?></td>
                    <td class="nowrap"><a href="/task?id=<?php echo $_t['task_id']; ?>"><?php if($_t['status_id'] == 3): ?><s><?php endif; ?><?php echo $_t['task_subject']; ?><?php if($_t['status_id'] == 3): ?></s><?php endif; ?></a></td>
                    <td class="nowrap"><?php echo date_format(new DateTime($_t['task_create_time']), 'd.m.Y H:i'); ?></td>
                    <td class="nowrap"><?php echo $_t['urg']; ?></td>
                    <td><?php echo $_t['cuser']; ?></td>
                    <td><?php echo $_t['user']; ?></td>
                    <td><span class="label label-<?php echo $taskStatus[$_t['status_id']]; ?>"><?php echo $_t['status']; ?></span></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
