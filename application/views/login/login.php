<?php if ($this->session->userdata('Error')) { ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '<?php echo $this->session->userdata('Error') ?>'
        });
    </script>
<?php } else { ?>
    <?php if ($this->session->userdata('Success')) { ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '<?php echo $this->session->userdata('Success') ?>'
            });
        </script>
    <?php } ?>
<?php } ?>
<!-- unset sessions -->
<?php $this->session->unset_userdata('Error'); ?>
<?php $this->session->unset_userdata('Success'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SigIn</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('css/login.css') ?>" rel="stylesheet">
</head>

<body class="text-center">
    <main class="form-signin w-100 m-auto">
        <?php echo form_open('') ?>
        <img class="mb-2" src="<?php echo base_url('assets/logo/BayambangLogo.png') ?>" alt="" width="100" height="100">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <div class="form-floating mb-2">
            <input type="text" class="form-control text-muted" name="username" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating mb-2">
            <input type="password" class="form-control text-muted" name="pass" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
        <?php echo form_close() ?>
    </main>

</body>

</html>