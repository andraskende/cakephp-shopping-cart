<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo $website; ?></loc>
    </url>
    <?php foreach($products as $product): ?>
        <url>
            <loc><?php echo $website; ?>product/<?php echo $product['Product']['slug']; ?></loc>
        </url>
    <?php endforeach; ?>
</urlset>
