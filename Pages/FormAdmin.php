<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/form.css">
    <title>Connexion</title>
</head>
<body>
    <div class="container-fluid">
        <h1 class="text-center"> Connexion </h1>
        <?php include '../header.php'; ?>
        <div class="row">
            <div class="col-9">
                <fieldset>
                    <form action="VerifAdmin.php" method="post">
                        <table>
                            <tr> 
                                <th>Nom d'utilisateur</th>
                                <td><input type="text" name="Usr" required></td>
                            </tr>
                            <tr>
                                <th> Password </th>
                                <td><input type="password" name="pass" required> </td>
                            </tr>
                            <tr>
                                <td><input type="submit" name="Envoyer"></td>
                                <td><input type="reset" name="Annuler"> </td>
                            </tr>
                        </table>
                    </form>
                </fieldset>
            </div>
            <div class="col-3">
                <?php include 'SideBar.php'; ?>
            </div>
        </div>
    </div>
    <?php include '../footer.php'; ?>
</body>
</html>