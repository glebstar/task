<div class="widget">
    <div class="widget-content table-container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Логин</th>
                    <th>Имя</th>
                    <th>Фамилия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->_pars['users'] as $_u): ?>
                <tr>
                    <td><?php echo $_u['id']; ?></td>
                    <td><?php echo $_u['login']; ?></td>
                    <td><?php echo $_u['firstname']; ?></td>
                    <td><?php echo $_u['lastname']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
