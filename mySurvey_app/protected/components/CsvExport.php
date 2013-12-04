<?php
/**
 * CsvExport
 *
 *  Helper class to output an CSV from a CActiveRecord array.
 *
 *  example usage:
 *      echo CsvExport::export(
 *          People::model()->findAll(), // a CActiveRecord array OR any CModel array
 *          array(
 *              'idpeople'=>array('number'),      'number' and 'date' are strings used by CFormatter
 *              'birthofdate'=>array('date'),=
 *          )
 *          ,true,'registros-hasta--'.date('d-m-Y H-i').".csv"
 *      );
 * Please refer to CFormatter about column definitions, this class will use CFormatter.
 * @author Christian Salazar <christiansalazarh@gmail.com> @bluyell @yiienespanol (twitter)
 * @author Fyodor Wolf <fwolf@bu.edu>
 * 
 * @licence Protected under MIT Licence.
 * @date 03 Dec 2013.
 *
 */
 
class CsvExport {
    /*
        export a data set to CSV output.
 
        Please refer to CFormatter about column definitions, this class will use CFormatter.
 
        @rows    CModel array. (you can use a CActiveRecord array because it extends from CModel)
        @coldefs    example: 'colname'=>array('number') (See also CFormatter about this string)
        @boolPrintRows    boolean, true print col headers taken from coldefs array key
        @csvFileName if set (defaults null) it echoes the output to browser using binary transfer headers
        @separator if set (defaults to ';') specifies the separator for each CSV field
    */
    public static function export($rows, $coldefs, $boolPrintRows=true, $csvFileName=null, $separator=';')
    {
        if($csvFileName != null)
        {
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header('Content-Disposition: attachment; filename="'.$csvFileName.'"');
            header("Content-Type: application/octet-stream");
            header("Content-Transfer-Encoding: binary");
        }

        //Open a file in memory.
        $csv = fopen('php://temp/maxmemory:'. (5*1024*1024), 'r+');
 
        if($boolPrintRows == true){
            fputcsv($csv, array_keys($coldefs));
        }
 
        foreach($rows as $row){
            $values = array();
            foreach($coldefs as $col=>$config){
                if(isset($row[$col])){
                    $val = $row[$col];
                    foreach($config as $conf)
                        if(!empty($conf))
                            $val = Yii::app()->format->format($val,$conf);
                    $values[] = $val;
                }
            }
            fputcsv($csv, $values);
        }

        rewind($csv);
        $output = stream_get_contents($csv);

        return $output;
    }
}