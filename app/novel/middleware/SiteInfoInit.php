<?php
/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace app\novel\middleware;

use app\model\Category;
use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;
use support\View;
/**
 * Class StaticFile
 * @package app\middleware
 */
class SiteInfoInit implements MiddlewareInterface
{
    public function process(Request $request, callable $next): Response
    {
        $header = [
            'title'=>'笔趣阁-无弹窗小说网,全文免费阅读',
            'icon-title'=>'笔趣阁',
            'description' => '笔趣阁是无弹窗广告的免费小说阅读网站,提供最新完结小说,全本玄幻小说、都市小说、穿越小说、网游小说、武侠仙侠、历史军事、修真同人等全本小说免费阅读,最新完本小说阅读就在笔趣阁',
            'keywords' => '笔趣阁,新笔趣阁,免费全本小说,全本TXT小说,无弹窗小说',
            'mobile_url' => 'm.huixiaoshuo.local.com',
            'pc_url' => getenv('APP_HOST'),
        ];
        $nav = Category::where('type',1)->orderBy('sort')->get()->toArray();
        View::assign([
            'header' => $header,
            'nav' => $nav,
            'current_url' => $request->path(),
        ]);
        /** @var Response $response */
        $response = $next($request);
        return $response;
    }
}
