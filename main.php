<!--dahee kim-->
<!-- 홈화면에 뭐 넣지..  -->

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <title>Team10</title>
<style>
Logo{
    color: black;
    cursor: pointer;
    font-size: 2.7vw;
    display: flex;
    align-items: center;
    font-weight: bold;
    text-decoration: none;
    height: 4.16vw;
}
ButtonLink{
    display: flex;
    justify-content: end;

  }
nav{
    background-color: lightblue;
    width: 100%;
    height: 4.16vw;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1rem;
    position: sticky;
    top: 0;
    z-index: 10;
  }
Container{
    display: inline;
    justify-content: space-between;
    height: 4.16vw;
    z-index: 1;
    width: 74vw;
    max-width: 1100px;

}
mainContainer{
    background: white;
    display: grid;
    justify-content: center;
    align-items: center;
    padding: 0 30px;
    height: 800px;
    position: relative;
    z-index: 1;
}
Button{
    display: inline;
    justify-content: end;

}
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
}

li {
    float: left;
}
</style>

</head>
<body>
<!--네비게이션 바-->
    <nav>
        <Container>
            <Logo>Movie</Logo>
            <!-- <Button>
                <ButtonLink href="/"> Search</a></Button>
                <Button><ButtonLink href="/"> Director</a></Button>
                <Button><ButtonLink href="/"> My Page</a></Button> -->
        </Container>
        <ul>
        <Button><li><a href="/"> Search</a></li></Button>
        <Button><li><a href="/">DashBoard</a></li></Button>
        <Button><li><a href="director.php"> Director</a></li></Button>
        <Button><li><a href="/"> My page</a></li></Button>
        <Button><li><a href="test.php"> Login</a></li></Button>
        
        
        </ul>
    </nav>

    <mainContainer>

    <h1>welcome to our page</h1>
       <div>
        <p> Let's see which movie is interesting</p>
        </div>
    </mainContainer>
</body>
</html>