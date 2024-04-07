<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/pinkping/inc/header.php';
  $sql = "SELECT * FROM category where step = 1";
  $result = $mysqli->query($sql);
  while($row = $result->fetch_object()){
    $cate1[]= $row;
  }
  
?>

<div class="container">
  <form action="">
    <div class="category row">
      <div class="col-md-4">
        <select class="form-select" aria-label="대분류" id="cate1">
          <option selected>대분류</option>
          <?php
            foreach($cate1 as $c1){
            
          ?>

          <option value="<?=$c1->code;?>"><?=$c1->name;?></option>

          <?php
            }
          ?>

        </select>
      </div>
      <div class="col-md-4">
        <select class="form-select" aria-label="중분류" id="cate2">

        </select>
      </div>
      <div class="col-md-4">
        <select class="form-select" aria-label="소분류" id="cate3">

        </select>
      </div>
    </div>
  </form>
</div>
<script>
  $('#cate1').change(function() {
    makeOption($(this), 2, '중분류', $('#cate2'));
  });
  $('#cate2').change(function() {
    makeOption($(this), 3, '소분류', $('#cate3'));
  });
  $('#cate3').change(function() {


  });


  async function makeOption(e, step, category, target) {
    let cate = e.val();
    let data = {
      cate: cate,
      step: step,
      category: category
    };
    console.log(data);


    try {
      const response = await fetch('printOption.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      });


      if (!response.ok) {
        throw new Error('Network response was not ok');
      }


      const result = await response.text();
      console.log(result);
      target.innerHTML = result;
    } catch (error) {
      console.error('Error:', error);
    }
  }

  /*
  function makeOption(e,step,category,target){
    let cate = e.val();
    비동기 방식으로 printoption 값 3개 (cate, step, category)에게 일 시키고 , 결과가 나오면 targe에 html 태그 생성 

    jquery 
    $.ajax({
      비동기방식, 
      타입(get, post ...),
      넘길 데이터,
      대상 url,
      결과의 형식,
      성공하면 할일
    })
    let data = {
      cate: cate,
      step: step,
      category: category
    }
    $.ajax({
      async:false, // success 결과가 나오면 그때 작업을 진행함.
      type:'post',
      data:data,
      url:'printOption.php',
      dataType:'html',
      success:function(result){
        target.html(result);
      }
    })
  }
  */ 
</script>
<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/pinkping/inc/footer.php';
?>