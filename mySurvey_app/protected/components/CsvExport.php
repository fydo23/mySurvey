<?php
/**
    CsvExport
 
    helper class to output an CSV from a CActiveRecord array.
 
    example usage:
 
        CsvExport::export(
            People::model()->findAll(), // a CActiveRecord array OR any CModel array
            array(
                'idpeople'=>array('number'),      'number' and 'date' are strings used by CFormatter
                'birthofdate'=>array('date'),
            )
        ,true,'registros-hasta--'.date('d-m-Y H-i').".csv");
 
 
    Please refer to CFormatter about column definitions, this class will use CFormatter.
 
    @author    Christian Salazar <christiansalazarh@gmail.com> @bluyell @yiienespanol (twitter)
    @licence Protected under MIT Licence.
    @date 07 october 2012.
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
        $endLine = PHP_EOL;
        $returnVal = '';
 
        if($csvFileName != null)
        {
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=".$csvFileName);
            header("Content-Type: application/octet-stream");
            header("Content-Transfer-Encoding: binary");
        }
 
        if($boolPrintRows == true){
            $names = '';
            foreach($coldefs as $col=>$config){
                $names .= $col.$separator;
            }
            $names = rtrim($names,$separator);
            if($csvFileName != null){
                echo $names.$endLine;
            }else
            $returnVal .= $names.$endLine;
        }
 
        foreach($rows as $row){
            $r = '';
            foreach($coldefs as $col=>$config){
 
                if(isset($row[$col])){
 
                    $val = $row[$col];
 
                    foreach($config as $conf)
                        if(!empty($conf))
                            $val = Yii::app()->format->format($val,$conf);
 
                    $r .= $val.$separator;
                }
            }
            $item = trim(rtrim($r,$separator)).$endLine;
            if($csvFileName != null){
                echo $item;
            }else{
                $returnVal .= $item;
            }
        }
        return $returnVal;
    }
}