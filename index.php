<?php
require_once 'vendor/autoload.php';

$days = \Donato\Hours\Parser::parse('/tmp/x3scr.5392');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Hours Helper</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
              integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
              crossorigin="anonymous">

        <style>
            .hour {
                width: 45px;
                padding: 0;
            }

            .original {
                display: none;
            }

            .changed .original {
                text-decoration: line-through;
                display: block;
                color: #ccc;
                font-size: 12px;
            }
        </style>
    </head>
    <body>
        <table class="table table-condensed" style="width: 1120px">
            <thead>
                <tr>
                    <th rowspan="2" width="40px">Date</th>
                    <th rowspan="2" width="60px">Obs. 1</th>
                    <th rowspan="2" width="60px">Obs. 2</th>
                    <th colspan="2">Morning</th>
                    <th colspan="2">Afternoon</th>
                    <th colspan="8">Extra Hours</th>
                </tr>
                <tr>
                    <th width="80px">In</th>
                    <th width="80px">Out</th>
                    <th width="80px">In</th>
                    <th width="80px">Out</th>

                    <th width="80px">Ex 1 In</th>
                    <th width="80px">Ex 1 Out</th>
                    <th width="80px">Ex 2 In</th>
                    <th width="80px">Ex 2 Out</th>
                    <th width="80px">Ex 3 In</th>
                    <th width="80px">Ex 3 Out</th>
                    <th width="80px">Ex 4 In</th>
                    <th width="80px">Ex 4 Out</th>
                </tr>
            </thead>
            <tbody>
                <?php
                /** @var \Donato\Hours\Day $day */
                foreach ($days as $day) { ?>
                    <tr class="day">
                        <td><?= $day->getDate()->format('d/m/Y') ?></td>
                        <td><?= $day->getObs1() ?></td>
                        <td><?= $day->getObs2() ?></td>

                        <?php
                        /** @var \Donato\Hours\Shift $shift */
                        foreach ($day->getShifts() as $shift) {
                            $in = $shift && $shift->getStart() ? $shift->getStart()->format('H:i') : '';
                            $out = $shift && $shift->getEnd() ? $shift->getEnd()->format('H:i') : '';
                            ?>
                            <td>
                                <input type="text" class="hour" value="<?= $in ?>" data-original="<?= $in ?>" pattern="[0-9:]" maxlength="5">
                                <span class="original"><?= $in ?></span>
                            </td>
                            <td>
                                <input type="text" class="hour" value="<?= $out ?>" data-original="<?= $out ?>" pattern="[0-9:]" maxlength="5">
                                <span class="original"><?= $out ?></span>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <script src="https://code.jquery.com/jquery-2.2.3.min.js"
                integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
                integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
                crossorigin="anonymous"></script>
        <script>
            $(document).ready(function () {
                $('.hour').each(function (index) {
                    if ($(this).val() !== $(this).data('original')) {
                        $(this).addClass('changed');
                    }
                });

                $('.hour').on('input', function () {
                    console.log($(this).val());
                    console.log($(this).data('original'));
                    if ($(this).val() !== $(this).data('original')) {
                        $(this).parent().addClass('changed');
                    } else {
                        $(this).parent().removeClass('changed');
                    }
                });
            });
        </script>
    </body>
</html>
