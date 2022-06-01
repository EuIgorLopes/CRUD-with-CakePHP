<div class="card">
    <div class="card-header bg-dark">
        <h4 class="card-title text-light">Editar contato</h4>
    </div>
    <div class="card-body">
        <?= $this->Form->create($contact, ["id" => "frm-edit-branch"]) ?>
        <div class="form-row">
            <div class="form-group col-12 col-lg-12">
                <label class="form-control-label">Nome:</label>
                <input type="text" required class="form-control" name="name" value="<?= $contact->name ?>" />
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-12 col-lg-6">
                <label class="form-control-label">E-mail:</label>
                <input type="email" required class="form-control" name="email" value="<?= $contact->email ?>" />
            </div>
            <div class="form-group col-12 col-lg-6">
                <label class="form-control-label">Telefone:</label>
                <input id="phone" type="text" required class="form-control" name="phone" value="<?= $contact->phone ?>" />
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-12 text-right">
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>    
</div>