<?php require './header.php'; ?>


<div class="container">
    <div class="row p-5 ">
        <form method="post" action="./questions.php">
            <button class="btn mx-2 my-2 btn-primary" value="history" name="tag" type="submit">HISTORY PDF</button>
        </form>
        <form method="post" action="./questions.php">
            <button class="btn mx-2 my-2 btn-success" value="cultural"  name="tag" type="submit">CULTURAL PDF</button>
        </form>

        <form method="post" action="./questions.php">
            <button class="btn mx-2 my-2 btn-danger" value="geography" name="tag" type="submit">GEOGRAPHY PDF</button>
        </form>

        <form method="post" action="./questions.php">
            <button class="btn mx-2 my-2 btn-dark" name="tag" value="gernalscience" type="submit">GERNAL SCIENCE PDF</button>
        </form>

        <form method="post" action="./questions.php">
            <button class="btn mx-2 my-2 btn-secondary" name="tag" value="currentgk" type="submit">CURRENT AFFAIR PDF</button>
        </form>
        <form method="post" action="./questions.php">
            <button class="btn mx-2 my-2 btn-primary" name="tag" value="all" type="submit">ALL TYPE PDF</button>
        </form>

        <form method="post" action="./questions.php">
            <button class="btn mx-2 my-2 btn-warning" name="tag" value="other" type="submit">OTHER PDF</button>
        </form>
    </div>
</div>

<?php require './footer.php' ?>