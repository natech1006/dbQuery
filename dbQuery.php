<?php 
// Variables Required for Database connection

$hostname = 'localhost';  // Enter your hostname here
$username = 'root';		  // Enter your username here
$password = '';           // Enter your password here
$database = 'testdb';     // Enter your dbname here
 // Connecting to database
$con = mysqli_connect($hostname,$username,$password,$database) or die('<h2>Cannot Connect to Database</h2>');
/*
* Instructions:
* To insert multiple values in single parameter use | array("value1", "value2") | 
* Please use "Double Quotes"  ( "myData" )  in parameters.
* use double quotes followed by single quotes WHEN USING STRING IN PARAMETER like ( "'my String Data'" )
*
* Please report error(s) at info@nabeeltariq.com 
* Version: 1.0.0
* Licence: GPLv2 or Later
* Database class to use database queries instantly.
Copyright (C) 2018  Nabeel Tariq

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
* 
 */

/**
 * Database Queries
 */
class dbQuery 
{
	
	function createTable($tableName,array $tableCol)
	{
		$noOfCols = sizeof($tableCol);
		$colString ='('; 

		for ($i=0; $i < $noOfCols; $i++) { 
			$colString = $colString.$tableCol[$i];

			if ($i +1 != $noOfCols) {
				$colString = $colString.', ';				
			}
		}
		$colString = $colString.')';

		$query = 'create table '.$tableName.' '.$colString;

		return $GLOBALS['con']->query($query);

	}
	function insert($tableName,array $tableCol, array $value)
	{
		$noOfCols = sizeof($tableCol);
		//Validation Check
		if ($noOfCols != sizeof($value)) {
			return "Cannot Execute the query. (No.Of cols not matching with no.Of values given)";
		}

		$colString = '(';
		$valString = '(';

		for ($i=0; $i < $noOfCols; $i++) { 
		  	$colString = $colString.$tableCol[$i];
		  	$valString = $valString.$value[$i];

		  	if ($i + 1 != $noOfCols) {
				$colString = $colString.', ';
				$valString = $valString.', ';				
			}

		  }  
		$colString = $colString.')';
		$valString = $valString.')';
		
		$query = 'insert into '.$tableName.' '.$colString.' values '.$valString;
		
		return $GLOBALS['con']->query($query);
	}

	function selectAll($tableName)
	{	
		
		$query = 'Select * from '.$tableName;
		return $GLOBALS['con']->query($query);
	}
	function selectAllWhere($tableName,$condition)
	{
		$query = 'select * from '.$tableName.' where '.$condition;
		return $GLOBALS['con']->query($query);	
	}
	function select( $tableName ,array $tableCol)
	{
		$noOfCols = sizeof($tableCol);
		$query = 'select ';
		for ($i=0; $i < $noOfCols ; $i++) { 
			$query = $query.$tableCol;

			if ($i + 1 != $noOfCols) {
				$query = $query.', ';
			}
		}
		
		$query = $query.' from '.$tableName;
		return $GLOBALS['con']->query($query);
	}
	function selectWhere( $tableName,array $tableCol, $condition)
	{
		$noOfCols = sizeof($tableCol);
		$query = 'select ';
		for ($i=0; $i < $noOfCols ; $i++) { 
			$query = $query.$tableCol;

			if ($i + 1 != $noOfCols) {
				$query = $query.', ';
			}
		}
		
		$query = $query.' from '.$tableName.' where '.$condition;
		return $GLOBALS['con']->query($query);

	}
	function delete($tableName, $condition)
	{
		$query = 'delete from '.$tableName.' where '.$condition;
		return $GLOBALS->query($query);
	}
	function update($tableName,$set,$condition)
	{
		$query = 'update '.$tableName.' set '.$set.' where '.$condition;
	}
	function limitAll($tableName, int $limit)
	{
		$query = 'select * from '.$tableName.' limit '.$limit;
		return $GLOBALS['con']->query($query);
	}
	function limitAllWhere($tableName, $condition, int $limit)
	{
		$query = 'select * from '.$tableName.' where '.$condition.' limit '.$limit;
		return $GLOBALS['con']->query($query);
	}
	function limit($tableName, array $tableCol, int $limit)
	{
		$colString = ' ';
		$noOfCols = sizeof($tableCol);

		for ($i=0; $i < noOfCols; $i++) { 
			$colString = $colString.$tableCol;
			if ($i + 1 != $noOfCols) {
				$colString = $colString.', ';
			}
		}
		$query = 'select '.$colString.' from '.$tableName.' limit '.$limit;

		return $GLOBALS->query($query);
	}
	function limitWhere($tableName,array $tableCol, $condition, int $limit)
	{
		$colString = ' ';
		$noOfCols = sizeof($tableCol);

		for ($i=0; $i < noOfCols; $i++) { 
			$colString = $colString.$tableCol;
			if ($i + 1 != $noOfCols) {
				$colString = $colString.', ';
			}
		}
		$query = 'select '.$colString.' from '.$tableName.' where '.$condition.' limit '.$limit;

		return $GLOBALS->query($query);

	}
	function drop($tableName)
	{
		$query = 'Drop table '.$tableName;
		return $GLOBALS['con']->query($query);
	}
	// No ALter Table function
}





 ?>