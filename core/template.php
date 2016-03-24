<?php
/** 
 *
 *	The MIT License (MIT)
 *	
 *	Copyright (c) 2015 Nurbality LLC
 *	
 *	Permission is hereby granted, free of charge, to any person obtaining a copy
 *	of this software and associated documentation files (the "Software"), to deal
 *	in the Software without restriction, including without limitation the rights
 *	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *	copies of the Software, and to permit persons to whom the Software is
 *	furnished to do so, subject to the following conditions:
 *	
 *	The above copyright notice and this permission notice shall be included in all
 *	copies or substantial portions of the Software.
 *	
 *	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 *	SOFTWARE.
 *	
 *	 
 *	DISCLAIMER
 *	Do not edit or add to this file if you wish to upgrade Jumbee to newer
 *	versions in the future. If you wish to customize Jumbee for your
 *	needs please refer to http://mvc.nurbality.com/documentation for more information. 
 *
 * Jumbee 
 *
 * @package     Jumbee
 * @copyright   Copyright (c) 2015 Nurbality LLC. (http://www.nurbality.com)
 * @license     http://jumbee.nurbality.com/license/mit
 */



class Layouts
{
	public function getLayout($view,$vars,$cache = false) 
	{
		try
		{
			$file = BP . DS . 'view' . DS . strtolower($view).'.phtml';
			
			if(!file_exists($file))
			{
				throw new Exception('<table cellspacing="0" cellpadding="0" align="center"><tr><td style="width:800px;height:30px;font-family:arial;font-weight:900;background: #DC143C;color: #FFF8DC;border: 1px solid #DC143C;padding:10px;">Framework Error </td></tr><tr><td style="border: 1px solid #DC143C;padding:10px;background:#FFC0CB;color: #800000;font-family:arial;">'.$view. ' view cannot be loaded.</td></tr></table>');
			}
			
			foreach($vars as $key=>$value)
			{
				$$key = $value;
			}			
			$template = (require $file);
			return $template;
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
			exit(0);
		}
		
	}
	
	public function getPartial($view,$vars)
	{
		try
		{
			$file = BP . DS . 'view' . DS . strtolower($view).'.phtml';
			if(!file_exists($file))
			{
				throw new Exception('<table cellspacing="0" cellpadding="0" align="center"><tr><td style="width:800px;height:30px;font-family:arial;font-weight:900;background: #DC143C;color: #FFF8DC;border: 1px solid #DC143C;padding:10px;">Framework Error </td></tr><tr><td style="border: 1px solid #DC143C;padding:10px;background:#FFC0CB;color: #800000;font-family:arial;">'.$view. ' view cannot be loaded.</td></tr></table>');
			}
			
			foreach($vars as $key=>$value)
			{
				$$key = $value;
			}			
			ob_start();
			include( $file);
			$output = ob_get_clean();
			return $output;
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
			exit(0);
		}
		
	}
}
?>
