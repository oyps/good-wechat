<?php

require('../good_wechat.php');
/**
 * 获取关键词和回复列表
 */
class Get_keyword_list
{
    public Good_wechat $wechat;
    public function __construct()
    {
        $this->wechat = new Good_wechat('../config.json');
    }
    /**
     * 获取列表数据
     */
    public function get_list()
    {
        $table_keyword = $this->wechat->mysql_config['table']['keyword'];
        $sql = "SELECT * FROM `$table_keyword` ORDER BY `id` DESC";
        $result = mysqli_query($this->wechat->conn, $sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $html = $this->make_html($data);
        echo $html;
    }
    /**
     * 生成HTML
     * @param $data 列表数据
     */
    public function make_html($data)
    {
        $html = '';
        foreach ($data as $item) {
            $html .= '
            <tr>
                <td contenteditable="true" class="keyword" data-id="' . $item['id'] . '">' . htmlspecialchars($item['keyword']) . '</td>
                <td contenteditable="true" class="reply" data-id="' . $item['id'] . '">' . htmlspecialchars($item['reply']) . '</td>
                <td class="text-nowrap text-danger user-select-none delete" role="button" data-id="' . $item['id'] . '">删除</td>
            </tr>';
        }
        return $this->wechat->parse_out($html);
    }
}
$obj = new Get_keyword_list();
$obj->get_list();
