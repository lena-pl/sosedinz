<?php

namespace App\Views;

use App\Services\AuthenticationService;

abstract class View
{

    protected $data;

    protected static $auth;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    abstract public function render();

    public static function registerAuthenticationService($auth)
    {
        self::$auth = $auth;
    }

    public function paginate($url, $p, $recordCount, $pageSize = 10, $maxContextLinks = 5)
    {
        $totalPages = ceil($recordCount / $pageSize);
        $previousPage = $p - 1;
        $nextPage = $p + 1;

        // calculate range of context links
        $low = $p - floor($maxContextLinks / 2);
        if ($low < 2) { $low = 2; }
        $high = $p + floor($maxContextLinks / 2);
        if ($high > $totalPages - 1) { $high = $totalPages - 1; }

        // if the low or high limit is hit, adjust context links to suit
        if ($low == 2) { $high = $maxContextLinks; }
        if ($high == $totalPages - 1) { $low = $totalPages - $maxContextLinks + 1; }

        // ensure the highs and lows don't exceed the number of pages
        if ($low < 2) { $low = 2; }
        if ($high > $totalPages - 1) { $high = $totalPages - 1; }

        ?>
        <nav>
          <ul class="pagination">

            <?php // previous ?>
            <?php if ($p > 1): ?>
              <li><a href="<?= $url ?>&amp;p=<?= $previousPage ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
            <?php else: ?>
              <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
            <?php endif; ?>

            <?php // first ?>
            <li <?php if ($p == 1): ?>class="active"<?php endif; ?>>
              <a href="<?= $url ?>&amp;p=1">1 <?php if ($p == 1): ?><span class="sr-only">(current)</span><?php endif;?></a>
            </li>

            <?php // ellipsis ?>
            <?php if ($low != 2): ?>
              <li class="disabled">
                <span>…</span>
              </li>
            <?php endif; ?>

            <?php // context loop ?>
            <?php for ($i = $low; $i <= $high ; $i += 1 ): ?>
              <li <?php if ($p == $i): ?>class="active"<?php endif; ?>>
                <a href="<?= $url ?>&amp;p=<?= $i ?>"><?= $i ?> <?php if ($p == $i): ?><span class="sr-only">(current)</span><?php endif;?></a>
              </li>
            <?php endfor; ?>

            <?php // ellipsis ?>
            <?php if ($high != $totalPages - 1): ?>
              <li class="disabled">
                <span>…</span>
              </li>
            <?php endif; ?>

            <?php // last ?>
            <?php if ($totalPages > 1): ?>
                <li <?php if ($p == $totalPages): ?>class="active"<?php endif; ?>>
                  <a href="<?= $url ?>&amp;p=<?= $totalPages ?>"><?= $totalPages ?> <?php if ($p == $totalPages): ?><span class="sr-only">(current)</span><?php endif;?></a>
                </li>
            <?php endif; ?>

            <?php // next ?>
            <?php if ($p < $totalPages): ?>
              <li><a href="./?page=movies&amp;p=<?= $nextPage ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
            <?php else: ?>
              <li class="disabled"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
            <?php endif; ?>

          </ul>
        </nav>

        <?php
    }

}
