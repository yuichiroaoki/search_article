<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>記事検索</title>
    </head>
    <body>
        <h1>記事検索</h1>
        <form>
        期間:<input type="date" name="start_date" value="<?php print $start_date; ?>">～<input type="date" name="end_date" value="<?php print $end_date; ?>">
        タイトル名:<input type="text" name="title" value="<?php print $title; ?>" placeholder="例）コロナウイルス">
        <p>URL:<input style="width:420px;" type="text" name="url" value="<?php print $url; ?>" placeholder="例）https://www.newsweekjapan.jp/stories/world/2020/04/42-4.php"></P>
        <input type="submit" name="search" value="検索">
        </form>
        <form style="margin-top:20px;">
        <input type="submit" value="検索条件をクリア" name="clear">
        </form>
<?php if ($searchflg !== false) { ?>
        <?php if (count($data) === 0) { ?>

        <p>検索対象は見つかりませんでした</p> 

        <?php } else { ?>

        <p><?php print count($total); ?>件中の<?php print $now * 20 - 19; ?>～<?php print $last_page; ?>件の記事を表示しています</p>

        <?php } ?>

        <?php if($now > 1) { ?> 
            <a href="/search.php?start_date=<?php print $start_date; ?>&end_date=<?php print $end_date; ?>&title=<?php print $title; ?>&url=<?php print $url; ?>&page_id=<?php print $now - 1; ?>">前へ</a>
        <?php } else { ?>
            <span>前へ  </span>
        <?php } ?>

        <?php for ($i = 1; $i <= $max_page; $i++) { ?> 
            <?php if ($i == $now) { ?>
                <span><?php print $now; ?></span>
            <?php } else { ?>
                <a href="search.php?start_date=<?php print $start_date; ?>&end_date=<?php print $end_date; ?>&title=<?php print $title; ?>&url=<?php print $url; ?>&page_id=<?php print $i; ?>"><?php print $i; ?></a>
            <?php } ?>
        <?php } ?>

        <?php if ($now < $max_page) { ?> 
            <a href="/search.php?start_date=<?php print $start_date; ?>&end_date=<?php print $end_date; ?>&title=<?php print $title; ?>&url=<?php print $url; ?>&page_id=<?php print $now + 1; ?>">次へ</a>
        <?php } else { ?>
            <span>次へ  </span>
        <?php } ?>

        <?php foreach ($data as $foo) { ?>
        <p>
            <span><?php print $foo['date']; ?></span>
            <a href="<?php print $foo['link']; ?>" target="_blank" style="margin-bottom:50px;"><?php print $foo['title']; ?></a>
            <div><?php print $foo['description']; ?></div> 
        </p>
        <?php } ?>

        <?php if($now > 1) { ?> 
            <a href="/search.php?start_date=<?php print $start_date; ?>&end_date=<?php print $end_date; ?>&title=<?php print $title; ?>&url=<?php print $url; ?>&page_id=<?php print $now - 1; ?>">前へ</a>
        <?php } else { ?>
            <span>前へ  </span>
        <?php } ?>

        <?php for ($i = 1; $i <= $max_page; $i++) { ?> 
            <?php if ($i == $now) { ?>
                <span><?php print $now; ?></span>
            <?php } else { ?>
                <a href="search.php?start_date=<?php print $start_date; ?>&end_date=<?php print $end_date; ?>&title=<?php print $title; ?>&url=<?php print $url; ?>&page_id=<?php print $i; ?>"><?php print $i; ?></a>
            <?php } ?>
        <?php } ?>

        <?php if ($now < $max_page) { ?> 
            <a href="/search.php?start_date=<?php print $start_date; ?>&end_date=<?php print $end_date; ?>&title=<?php print $title; ?>&url=<?php print $url; ?>&page_id=<?php print $now + 1; ?>">次へ</a>
        <?php } else { ?>
            <span>次へ  </span>
        <?php } ?>
<?php } ?>
    </body>
</html>