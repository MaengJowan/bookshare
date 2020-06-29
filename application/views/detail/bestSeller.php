<!--
페이지를 로드한다.
db에서 데이터를 가져온다.
가져온 데이터를 카드에 알맞게 뿌린다.
뿌린 카드를 렌더링한다.

외래키로 이메일, 닉네임 추가
카드에 데이터 넣고 foreach 돌리기

-->
<?php
#api 호출
$key = getenv('API_KEY');
$api = "http://book.interpark.com/api/bestSeller.api?key=$key&categoryId=100";
$data_type = "output=json";
$url = "$api" . "&$data_type";
$curl_handle = curl_init();
curl_setopt($curl_handle, CURLOPT_URL, $url);
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($curl_handle);
curl_close($curl_handle);
$array = json_decode($output, true);

$base_url = base_url() . 'detail/bestSeller/';
?>
<div id="bestSeller" class="hero detail__page">
    <?php $this->load->view("templates/aside") ?>
    <main class="bestseller__main">
        <?php
        //  print_r($array);
        foreach ($array['item'] as $item) {
            // echo $item['coverLargeUrl']."\n";
        ?>

            <div class="card" onclick="location.href=`<?= $base_url . $item['itemId'] ?>`">
                <div class="card-image">
                    <figure class="image">
                        <img src="<?= $item['coverSmallUrl'] ?>" alt="Placeholder image">
                    </figure>
                </div>

                <div class="card-content">
                    <div class="media">
                        <div class="media-content">
                            <p class="title is-4"><?= $item['title'] ?></p>
                            <p class="subtitle is-6">@<?= $item['author'] ?></p>
                        </div>
                    </div>

                    <div class="content">
                        <p class="description"><?= $item['description']; ?></p>
                        <a href="#">#<?= $item['priceStandard']; ?>원</a> <a href="#">#<?= $item['discountRate']; ?>% 할인중!</a><strong> <?= $item['saleStatus'] ?></strong>
                    </div>
                </div>
            </div>

        <?php
        }
        ?>
    </main>
</div>