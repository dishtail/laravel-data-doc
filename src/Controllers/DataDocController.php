<?php

namespace Dishtail\DataDoc\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class DataDocController extends Controller
{

    /**
     * 读取数据库信息
     * @email dishtail@gmail.com
     * @author dishtail
     * @return mixed
     */
    private function initTablesData()
    {
        //获取数据库表名称列表
        $tables = DB::select('SHOW TABLE STATUS ');
        foreach ($tables as $key => $table) {
            //获取改表的所有字段信息
            $columns = DB::select("SHOW FULL FIELDS FROM `" . $table->Name . "`");
            $table->columns = $columns;
            $tables[$key] = $table;
        }
        return $tables;
    }

    /**
     * 显示字典
     * @email dishtail@gmail.com
     * @author dishtail
     * @return mixed
     */
    public function index()
    {
        $tables = $this->initTablesData();
        $customerView = 'vendor.laravel-ddoc.index';
        return view(view()->exists($customerView) ? $customerView : 'ddoc::index', compact('tables'));
    }

    /**
     * 数据库表名字
     * @email dishtail@gmail.com
     * @author dishtail
     * @param $table
     * @return string
     */
    private function tableName($table)
    {
        return "* [" . $table->Name . "](#" . $table->Name . ")\n";
    }

    /**
     *数据库 详情
     *
     * @param $key
     * @param $table
     */
    private function tableDetail($key, $table)
    {
        $content = "\n\n-------------------\n\n";
        $content .= "<h3 id='" . $table->Name . "'>" . ($key + 1) . ". " . $table->Name . "</h3>\n\n";
        $table->Comment && $content .= '> ' . $table->Comment . "\n\n";
        $content .= "|字段|类型|为空|键|默认值|特性|备注|\n|:---:|:---:|:---:|:---:|:---:|:---:|:---:|\n";
        foreach ($table->columns as $column) {
            $content .= "|" . $column->Field . "|" . $column->Type . "|" . $column->Null . "|" . $column->Key . "|" . $column->Default . "|" . $column->Extra . "|" . $column->Comment . "|\n";
        }
        return $content;
    }
}
