<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Atrium Campus Assessment</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">

    <!-- STYLES -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style {csp-style-nonce}>
    </style>
</head>
<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">First Name</th>
                <th scope="col">Middle Initial</th>
                <th scope="col">Last Name</th>
                <th scope="col">Loan Amount</th>
                <th scope="col">Value</th>
                <th scope="col">LTV</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($loans as $loan): ?>
                <tr>
                    <td>
                        <input
                            class="form-control"
                            type="text"
                            form="form-<?= esc($loan['id']) ?>"
                            name="first_name"
                            value="<?= esc($loan['first_name']) ?>"
                            >
                    </td>
                    <td>
                        <input
                            class="form-control"
                            type="text"
                            form="form-<?= esc($loan['id']) ?>"
                            name="middle_initial"
                            value="<?= esc($loan['middle_initial']) ?>"
                            >
                    </td>
                    <td>
                        <input
                            class="form-control"
                            type="text"
                            form="form-<?= esc($loan['id']) ?>"
                            name="last_name"
                            value="<?= esc($loan['last_name']) ?>"
                            required
                            >
                    </td>
                    <td>
                        <input
                            class="form-control"
                            type="text"
                            form="form-<?= esc($loan['id']) ?>"
                            name="loan"
                            value="<?= esc(number_format($loan['loan'], 2)) ?>"
                            required
                            >
                    </td>
                    <td>
                        <input
                            class="form-control"
                            type="text"
                            form="form-<?= esc($loan['id']) ?>"
                            name="value"
                            value="<?= esc(number_format($loan['value'], 2)) ?>"
                            required
                            >
                    </td>
                    <td>%</td>
                    <td>
                        <form id="form-<?= esc($loan['id']) ?>" method="POST" action="/">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="PUT">

                            <button type="submit" class="btn btn-info">Update</button>
                        </form>
                        <form id="delete-loan" method="POST" action="/<?= esc($loan['id']) ?>">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
        </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
