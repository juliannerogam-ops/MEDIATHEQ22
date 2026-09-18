<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header('Location: /MEDIATHEQ22/views/backend/security/login.php');
    exit;
}

include '../../header.php';
?>

<!-- Bootstrap admin dashboard template -->
<div>
    <hr class="my-3">
    <div style="color: black; font-size: 30px; font-family: Montserrat; font-weight: 400; padding-left: 3rem ;word-wrap: break-word">Liens permettant d'administrer le Blog Médiathèque</div>    
    <hr class="my-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>Bienvenue sur le dashboard !</p>
            </div>
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Objets</th>
                            <th>Actions</th>
                            <th>Commentaires</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Users</td>
                            <td>
                                <a href="/MEDIATHEQ22/views/backend/users/list.php" class="btn btn-primary">List</a>
                                <a href="/MEDIATHEQ22/views/backend/users/create.php" class="btn btn-success">Create</a>
                                <span class="btn btn-warning disabled">Edit</span>
                                <span class="btn btn-danger disabled">Delete</span>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Albums</td>
                            <td>
                                <a href="/MEDIATHEQ22/views/backend/albums/list.php" class="btn btn-primary">List</a>
                                <a href="/MEDIATHEQ22/views/backend/albums/create.php" class="btn btn-success">Create</a>
                                <span class="btn btn-warning disabled">Edit</span>
                                <span class="btn btn-danger disabled">Delete</span>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Artistes</td>
                            <td>
                                <a href="/MEDIATHEQ22/views/backend/artistes/list.php" class="btn btn-primary">List</a>
                                <a href="/MEDIATHEQ22/views/backend/artistes/create.php" class="btn btn-success">Create</a>
                                <span class="btn btn-warning disabled">Edit</span>
                                <span class="btn btn-danger disabled">Delete</span>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Groupes</td>
                            <td>
                                <a href="/MEDIATHEQ22/views/backend/groupes/list.php" class="btn btn-primary">List</a>
                                <a href="/MEDIATHEQ22/views/backend/groupes/create.php" class="btn btn-success">Create</a>
                                <span class="btn btn-warning disabled">Edit</span>
                                <span class="btn btn-danger disabled">Delete</span>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Likes</td>
                            <td>
                                <a href="/MEDIATHEQ22/views/backend/likes/list.php" class="btn btn-primary">List</a>
                                <a href="/MEDIATHEQ22/views/backend/likes/create.php" class="btn btn-success">Create</a>
                                <span class="btn btn-warning disabled">Edit</span>
                                <span class="btn btn-danger disabled">Delete</span>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Titres</td>
                            <td>
                                <a href="/MEDIATHEQ22/views/backend/titres/list.php" class="btn btn-primary">List</a>
                                <a href="/MEDIATHEQ22/views/backend/titres/create.php" class="btn btn-success">Create</a>
                                <span class="btn btn-warning disabled">Edit</span>
                                <span class="btn btn-danger disabled">Delete</span>
                            </td>
                            <td></td>
                        </tr>
<!--                         <tr>
                            <td>Statuts</td>
                            <td>
                                <a href="/views/backend/statutsCC/list.php" class="btn btn-primary disabled">List</a>
                                <a href="/views/backend/statutsCC/create.php" class="btn btn-success disabled">Create</a>
                                <a href="/views/backend/statutsCC/edit.php" class="btn btn-warning disabled">Edit</a>
                                <a href="/views/backend/statutsCC/delete.php" class="btn btn-danger disabled">Delete</a>
                            </td>
                            <td>
                                <p>CC S2 : Exemple CRUD fourni</p>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>