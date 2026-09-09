<?= $this->extend('registrar/layout') ?>

<?= $this->section('active-enrollment') ?>
active
<?= $this->endSection() ?>

<?= $this->section('page-title') ?>
Enrollment
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container-fluid shadow-sm rounded bg-white p-3">
    <h4><?= $record_id['id'] ?></h4>
    <div class="row">

    </div>
</div>

<script>
    function ViewRecord()
    {
        return {
            errors: '',
            record: '',


            async getRecord(){
                const res = await fetch('/registrar/manage-enrollment/get-record/');
            }
        }
    }
</script>
<?= $this->endSection() ?>