<section class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h2 class="h4 mb-3"><?= html_escape($title) ?></h2>
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
                <?php endif; ?>
                <?= validation_errors('<div class="alert alert-danger">', '</div>') ?>
                <?= form_open('contact') ?>
                    <div class="mb-3">
                        <?= form_label('Imię', 'name', array('class' => 'form-label')) ?>
                        <?= form_input(array('name' => 'name', 'id' => 'name', 'value' => set_value('name'), 'class' => 'form-control', 'required' => true)) ?>
                    </div>
                    <div class="mb-3">
                        <?= form_label('E-mail', 'email', array('class' => 'form-label')) ?>
                        <?= form_input(array('name' => 'email', 'id' => 'email', 'type' => 'email', 'value' => set_value('email'), 'class' => 'form-control', 'required' => true)) ?>
                    </div>
                    <div class="mb-3">
                        <?= form_label('Wiadomość', 'message', array('class' => 'form-label')) ?>
                        <?= form_textarea(array('name' => 'message', 'id' => 'message', 'value' => set_value('message'), 'class' => 'form-control', 'rows' => 4, 'required' => true)) ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Wyślij</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</section>
