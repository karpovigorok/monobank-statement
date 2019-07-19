@extends('MonobankAPI::layouts.app')

@section('title', "Виписка клієнта $statement->person_name | monobank | Universal Bank")

@section('content')
    <div class="container">
        <h2 class="text-muted">monobank | Universal Bank</h2>
        <p>Виписка клієнта <?php echo $statement->person_name; ?> за
            період <?php echo date('d.m.Y H:i:s', $statement->startDate); ?> &mdash; <?php echo date('d.m.Y H:i:s', $statement->endDate); ?></p>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
            <tr>
                <th>Дата</th>
                <th>Операція</th>
                <th>Сума</th>
                <th>Валюта</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($statement->rows as $statement_row):

            ?>
            <tr>
                <td><?php echo date('d.m.Y H:i:s', $statement_row->time); ?></td>
                <td><?php echo $statement_row->description; ?></td>
                <td <?php if($statement_row->amount > 0):?>class="text-success" <?php endif;?>>
                    <?php echo number_format($statement_row->amount / 100, 2, '.', ''); ?>
                </td>
                <td><?php echo $iso4217->getByNumeric($statement_row->currencyCode)['alpha3']; ?></td>
            </tr>
            <?php
            endforeach;
            ?>
            </tbody>
        </table>
    </div>
@endsection