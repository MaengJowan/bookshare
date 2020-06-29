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
?>
<div id="bestseller_post" class="hero detail__page">
    <?php $this->load->view("templates/aside"); ?>
    <main>
        <?php
        //  print_r($array);
        foreach ($array['item'] as $item) {
            // echo $item['coverLargeUrl']."\n";
            if ($item['itemId'] == $id) {
                $title = $item['title'];
                $isbn = $item['isbn'];
                $url = $item['link'];
                $author = $item['author'];
                $description = $item['description'];
                $priceSales = $item['priceSales'];
                $discountRate = $item['discountRate'];
                $coverLargeUrl = $item['coverLargeUrl'];
                $categoryName = $item['categoryName'];
                $publisher = $item['publisher'];
                $pubDate = $item['pubDate'];
            }
        };
        ?>
        <div class="table-container bestseller_post_table_container">
            <table class="table bestseller_post_table">
                <tbody>
                    <tr>
                        <td colspan='3' class="table_td_mobile_img"><img class="bookcover" src="<?= $coverLargeUrl ?>" /></td>
                    </tr>
                    <tr>
                        <td rowspan="6" class="table_td_img"><img class="bookcover" src="<?= $coverLargeUrl ?>" /></td>
                    </tr>
                    <tr class="table_book_info">
                        <td class="table_td_category">카테고리 > 제목</td>
                        <td class="table_td_category_content"><?= $categoryName ?> > <?= $title ?></td>
                    </tr>
                    <tr class="table_book_info">
                        <td>ISBN</td>
                        <td><?= $isbn ?></td>
                    </tr>
                    <tr class="table_book_info">
                        <td>작가</td>
                        <td><?= $author ?></td>
                    </tr>
                    <tr class="table_book_info">
                        <td>판매 가격 / 할인율</td>
                        <td><?= $priceSales ?> / <?= $discountRate ?>% ↓</td>
                    </tr>
                    <tr class="table_book_info">
                        <td>출판사 / 등록일</td>
                        <td><?= $publisher ?> / <?= $pubDate ?></td>
                    </tr>
                    <tr class="table_book_description">
                        <td colspan="3"><?= $description ?> <a href="<?= $url ?>" target="_blank"> > 책 보러가기</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>