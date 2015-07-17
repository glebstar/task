<div id="newtaskmodal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Новая задача</h3>
    </div>
    <div class="modal-body">
        <div id="newtaskform">
            <form>
                <fieldset>
                    <div id="newtaskerror" class="control-group error hide">
                        <label></label>
                    </div>
                    <div class="control-group">
                        <label>Тема</label>
                        <input id="newtasksubjecti" type="text" class="span5">
                        <span class="help-block hide"></span>
                    </div>

                    <div class="control-group">
                        <label>Задание</label>
                        <textarea id="newtasktexti" class="span5" rows="2"></textarea>
                        <span class="help-block hide"></span>
                    </div>

                    <div class="control-group">
                        <label>Исполнитель</label>
                        <select id="newtaskuseri" class="span5">
                            <option value="0">-- выберите из списка --</option>
                            <?php foreach ($this->_pars['allusers'] as $_u): ?>
                                <option value="<?php echo $_u['id']; ?>"><?php echo $_u['lastname']; ?> <?php echo $_u['firstname']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="help-block hide"></span>
                    </div>

                    <label>Срочность</label>
                    <select id="newtaskurgi" class="span5">
                        <option value="1">Низкая</option>
                        <option selected="selected" value="2">Средняя</option>
                        <option value="3">Высокая</option>
                    </select>

                    <label>Сложность</label>
                    <select id="newtaskcompi" class="span5">
                        <option value="1">Легкая</option>
                        <option selected="selected" value="2">Средняя</option>
                        <option value="3">Сложная</option>
                    </select>
                </fieldset>
            </form>
        </div>
        <div id="newtasksuccess" class="hide alert alert-success">
            <h4>Задача создана успешно</h4>
        </div>
    </div>
    <div class="modal-footer">    
        <button class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</button>
        <button id="newtaskclosebtn" class="btn btn-primary hide">К списку задач</button>
        <button id="newtasksavebtn" class="btn btn-primary">Cохранить</button>
    </div>
</div>
