<?php
/**
 * @author ran.ran
 * 重写分页插件
 */
namespace myzero1app\themes\adminlte\widgets;
use Yii;
use yii\helpers\Html;
class LinkPager2 extends \yii\widgets\LinkPager{
    
    /**
     * {pageButtons} {customPage}
     */
    public $template = '{pageButtons}{customPage}';
    
    /**
     * Executes the widget.
     * This overrides the parent implementation by displaying the generated page buttons.
     */
    public function run()
    {
        if ($this->registerLinkTags) {
            $this->registerLinkTags();
        }
       echo $this->renderPageContent();
    }
    
    protected function renderPageContent(){
       return preg_replace_callback('/\\{([\w\-\/]+)\\}/', function ($matches) {
            $name = $matches[1];
            if('customPage' == $name){
                return $this->renderCustomPage();
            }
            else if('pageButtons' == $name){
                return $this->renderPageButtons();
            }
            return "";
        }, $this->template);
    }
    
    protected function renderCustomPage()
    { 
        $pageCount = $this->pagination->getPageCount();
        if ($pageCount < 2 && $this->hideOnSinglePage) {
            return '';
        }
        
        $buttons = [];
        $currentPage = $this->pagination->getPage();
        $goPage = $currentPage + 2;
        $goHtml = <<<goHtml
            <div class="form" style="float: left; color: #999; margin-left: 10px; font-size: 12px;line-height:34px">
             <span class="text">共 {$pageCount} 页</span>
             <span class="text">到第</span>
             <input class="input" type="number" value="{$goPage}" min="1" max="{$pageCount}" aria-label="页码输入框" style="text-align: center; height: 32px; border: 1px solid #ddd;
border-radius: 4px; margin-top: 5px; width: 46px;">
             <span class="text">页</span>
             <span class="btn go-page" role="button" tabindex="0" style="border: solid 1px #337ab7; color: #fff; background-color: #337ab7; padding: 0px; height: 32px; width: 46px; line-height: 30px;">确定</span>
            </div>
goHtml;
        $buttons[] = $goHtml;
        $pageLink = $this->pagination->createUrl(false);
        $goJs = <<<goJs
            $(".go-page").on("click", function () {
             var _this = $(this),
              _pageInput = _this.siblings("input"),
              goPage = _pageInput.val(),
              pageLink = "{$pageLink}";
              pageLink = pageLink.replace("page=1", "page="+goPage);
             if (goPage >= 1 && goPage <= {$pageCount}) {
              window.location.href=pageLink;
             } else {
              _pageInput.css('border','2px solid #e82d2d').focus();
             }
            });
goJs;
        $this->view->registerJs($goJs);
        
        return Html::tag('ul', implode("\n", $buttons), $this->options);
    }
}