<?php
namespace Underbar;
trait Enumerable {
public function each(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::each',$args);}
public function map(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::map',$args);}
public function collect(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::collect',$args);}
public function mapKey(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::mapKey',$args);}
public function collectKey(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::collectKey',$args);}
public function reduce(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::reduce',$args);}
public function inject(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::inject',$args);}
public function foldl(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::foldl',$args);}
public function reduceRight(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::reduceRight',$args);}
public function foldr(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::foldr',$args);}
public function find(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::find',$args);}
public function detect(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::detect',$args);}
public function findSafe(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::findSafe',$args);}
public function detectSafe(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::detectSafe',$args);}
public function filter(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::filter',$args);}
public function select(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::select',$args);}
public function where(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::where',$args);}
public function findWhere(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::findWhere',$args);}
public function findWhereSafe(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::findWhereSafe',$args);}
public function reject(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::reject',$args);}
public function every(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::every',$args);}
public function all(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::all',$args);}
public function some(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::some',$args);}
public function any(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::any',$args);}
public function sum(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::sum',$args);}
public function contains(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::contains',$args);}
public function invoke(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::invoke',$args);}
public function pluck(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::pluck',$args);}
public function max(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::max',$args);}
public function min(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::min',$args);}
public function sortBy(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::sortBy',$args);}
public function groupBy(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::groupBy',$args);}
public function countBy(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::countBy',$args);}
public function shuffle(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::shuffle',$args);}
public function toArray(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::toArray',$args);}
public function size(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::size',$args);}
public function parallelMap(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::parallelMap',$args);}
public function parallelCollect(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::parallelCollect',$args);}
public function first(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::first',$args);}
public function head(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::head',$args);}
public function take(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::take',$args);}
public function firstSafe(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::firstSafe',$args);}
public function headSafe(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::headSafe',$args);}
public function takeSafe(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::takeSafe',$args);}
public function takeWhile(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::takeWhile',$args);}
public function initial(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::initial',$args);}
public function last(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::last',$args);}
public function lastSafe(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::lastSafe',$args);}
public function rest(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::rest',$args);}
public function tail(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::tail',$args);}
public function drop(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::drop',$args);}
public function dropWhile(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::dropWhile',$args);}
public function compact(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::compact',$args);}
public function flatten(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::flatten',$args);}
public function without(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::without',$args);}
public function union(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::union',$args);}
public function difference(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::difference',$args);}
public function uniq(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::uniq',$args);}
public function unique(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::unique',$args);}
public function zip(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::zip',$args);}
public function zipWith(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::zipWith',$args);}
public function object(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::object',$args);}
public function indexOf(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::indexOf',$args);}
public function lastIndexOf(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::lastIndexOf',$args);}
public function sortedIndex(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::sortedIndex',$args);}
public function range(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::range',$args);}
public function cycle(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::cycle',$args);}
public function repeat(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::repeat',$args);}
public function iterate(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::iterate',$args);}
public function pop(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::pop',$args);}
public function push(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::push',$args);}
public function reverse(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::reverse',$args);}
public function shift(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::shift',$args);}
public function sort(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::sort',$args);}
public function sortByKey(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::sortByKey',$args);}
public function splice(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::splice',$args);}
public function unshift(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::unshift',$args);}
public function concat(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::concat',$args);}
public function join(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::join',$args);}
public function slice(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::slice',$args);}
public function keys(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::keys',$args);}
public function values(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::values',$args);}
public function pairs(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::pairs',$args);}
public function invert(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::invert',$args);}
public function extend(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::extend',$args);}
public function pick(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::pick',$args);}
public function omit(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::omit',$args);}
public function defaults(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::defaults',$args);}
public function tap(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::tap',$args);}
public function duplicate(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::duplicate',$args);}
public function has(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::has',$args);}
public function chain(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Strict::chain',$args);}
public function lazy(){return Lazy::chain($this);}
}
