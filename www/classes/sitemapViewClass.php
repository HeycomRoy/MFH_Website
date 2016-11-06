<?php


class SitemapView extends View///////////////////////////////////////this class is for display site map
{
    protected function displayContent()
    {
        $html = '<!--content container strat-->
		  <div id="content_BG">'."\n";
        $html .= '<h2 id="sitemap_t">'.$this->rs['PageHeading'].'</h2>'."\n";
        $html .= '  <div class="Abt_form">'."\n";
        $html .= '      <ul>'."\n";
        $html .= '          <li class="s_link"><a href="index.php?pageID=Home">Home</a></li>'."\n";
        $html .= '          <li class="s_link"><a href="index.php?pageID=Course">Courses &amp; Fees</a></li>'."\n";
        $html .= '          <li class="s_link"><a href="index.php?pageID=Studentlife">Student Life</a></li>'."\n";
        $html .= '          <li class="s_link"><a href="index.php?pageID=Aboutus">About Us</a></li>'."\n";
        $html .= '          <li class="s_link"><a href="index.php?pageID=Contact">Contact Us</a></li>'."\n";
        $html .= '      </ul>'."\n";
        $html .= '  </div>'."\n";
        $html .= '</div>'."\n";
        $html .= '<div class="content_break" ></div>'."\n";
        return $html;
    }
}
?>