<div class="card">
  <div class="card-header bg-dark">
    <a class="btn btn-primary float-right" href="<?= $this->Url->build('/add/', ['fullBase' => true]) ?>" role="button">Cadastrar novo contato</a>
    <h4 class="card-title text-light">Agenda</h4>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table id="example1" class="table table-bordered table-striped table-hover data-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($contacts as $key => $value) { ?>
            <tr>
              <td><?= $key + 1 ?></td>
              <td><?= $value->name ?></td>
              <td><?= $value->email ?></td>
              <td><?= $value->phone ?></td>
              <td class="text-center">
                <a  class="btn btn-warning btn-default" href="<?= $this->Url->build('/edit/' . $value->id, ['fullBase' => true]) ?>" role="button">Editar</a>
                <button type="button" class="btn btn-danger btn-default" data-toggle="modal"data-target="#delete-modal-<?= $key ?>">Excluir</button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php foreach ($contacts as $key => $value) { ?>
  <div class="modal fade" tabindex="-1" role="dialog" id="delete-modal-<?= $key ?>">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content ">
        <div class="modal-body">         
          <p class="text-center">Tem certeza que deseja excluir o contato <?= $value->name ?>?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Não</button>
          <a href="<?= $this->Url->build(["action" => "delete", $value->id]) ?>" class="btn btn-danger">Sim</a>
        </div>
      </div>
    </div>
  </div>
<?php } ?>