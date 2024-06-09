<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Atrium Campus Assessment</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1 style="text-align:center;">Atrium Campus Assessment</h1>
    <p style="text-align:center;"><i>By Eric Johnson</i></p>

    <?php
        helper('form');
        $errors = validation_errors();
    ?>

    <?php if (! empty($errors)): ?>
        <div class="alert alert-danger" role="alert">
            <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <table id="loanTable" class="table">
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
            <tr>
                <td>
                    <input
                        class="form-control"
                        type="text"
                        form="new-loan"
                        name="first_name"
                        placeholder="First name..."
                        >
                </td>
                <td>
                    <input
                        class="form-control"
                        type="text"
                        form="new-loan"
                        name="middle_initial"
                        placeholder="Middle initial..."
                        >
                </td>
                <td>
                    <input
                        class="form-control"
                        type="text"
                        form="new-loan"
                        name="last_name"
                        placeholder="Last name..."
                        required
                        >
                </td>
                <td>
                    <input
                        class="form-control loanInput"
                        type="text"
                        form="new-loan"
                        name="loan"
                        placeholder="Loan amount..."
                        required
                        >
                </td>
                <td>
                    <input
                        class="form-control valueInput"
                        type="text"
                        form="new-loan"
                        name="value"
                        placeholder="Value..."
                        required
                        >
                </td>
                <td><span class="result"></span></td>
                <td>
                    <form id="new-loan" method="POST" action="/">
                        <?= csrf_field() ?>

                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </td>
            </tr>
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
                            class="form-control loanInput"
                            type="text"
                            form="form-<?= esc($loan['id']) ?>"
                            name="loan"
                            value="<?= esc($loan['loan']) ?>"
                            required
                            >
                    </td>
                    <td>
                        <input
                            class="form-control valueInput"
                            type="text"
                            form="form-<?= esc($loan['id']) ?>"
                            name="value"
                            value="<?= esc($loan['value']) ?>"
                            required
                            >
                    </td>
                    <td><span class="result"></span></td>
                    <td>
                        <div style="display:flex">
                            <form
                                id="form-<?= esc($loan['id']) ?>"
                                method="POST"
                                action="/<?= esc($loan['id']) ?>"
                                style="margin-right:5px"
                                >
                                <?= csrf_field() ?>
                                <!-- I want to use the PUT method here, but I came across some odd behavior in automated tests -->

                                <button type="submit" class="btn btn-info">Update</button>
                            </form>
                            <form
                                id="delete-loan"
                                method="POST"
                                action="/<?= esc($loan['id']) ?>"
                                >
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">

                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    // Function to compute the result for a single row
    function computeRowResult(row) {
        const loanAmount = row.querySelector('.loanInput');
        const valueAmount = row.querySelector('.valueInput');
        const resultSpan = row.querySelector('.result');

        if (!loanAmount || !valueAmount) {
            if (! resultSpan) return;
            resultSpan.textContent = 'N/A';
            return;
        }

        const valueForLoanAmount = parseFloat(loanAmount.value);
        const valueForValueAmount = parseFloat(valueAmount.value);

        const result = (valueForLoanAmount / valueForValueAmount) * 100;
        resultSpan.textContent = isNaN(result) ? 'N/A' : result.toFixed(2) + '%';
    }

    // Function to compute results for all rows in the table
    function computeTableResults() {
        const table = document.getElementById('loanTable');
        const rows = table.querySelectorAll('tr');
        // Start from index 1 to skip the header row
        for (let i = 1; i < rows.length; i++) {
            computeRowResult(rows[i]);
        }
    }

    // Add event listeners to all input elements for live computation
    document.querySelectorAll('.loanInput, .valueInput').forEach(input => {
        input.addEventListener('input', computeTableResults);
    });

    // Initial computation when the page loads
    computeTableResults();
</script>

</body>
</html>
