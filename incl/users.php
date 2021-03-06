<?php
if (!isCanSee($_SESSION['role'], [2])) {
    die();
}


if (isset($_GET['ban'])) {
    $sql = "DELETE FROM user WHERE id = :id";

    $params = [
        'id' => $_GET['ban']
    ];
    $prepare = $conn->prepare($sql);
    $prepare->execute($params);
}

$sql = "SELECT * FROM user";
$prepare = $conn->prepare($sql);
$prepare->execute();

?>

<div class="page__users users">

    <div class="users__container container">

        <div class="title__row">

            <h1 class="title__status">Админ панель</h1>

        </div>

        <form name="order" class="cart__form">

            <div class="cart__table-div">

                <table class="cart__table">

                    <tr>

                        <th>Код пользователя</th>

                        <th>ФИО</th>

                        <th>Email</th>

                    </tr>
                    <?php

                    while ($user = $prepare->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>

                            <td>#<?= $user['id'] ?></td>

                            <td><?= $user['fio'] ?></td>

                            <td><?= $user['email'] ?></td>

                            <?php

                            if ($user['role_id'] != 2) {
                                ?>
                                <td><a class="ban__link" href="?p=users&ban=<?= $user['id'] ?>">Забанить</a></td>
                                <?php
                            } else {
                                ?>
                                <td></td>
                                <?php
                            }

                            ?>

                            

                        </tr>
                        <?php
                    }

                    ?>


                </table>

            </div>

        </form>

    </div>

</div>