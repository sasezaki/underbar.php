<?php
namespace Underbar;
trait Enumerable {
public function each(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::each',$args);}
public function map(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::map',$args);}
public function collect(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::collect',$args);}
public function mapKey(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::mapKey',$args);}
public function collectKey(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::collectKey',$args);}
public function parallelMap(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::parallelMap',$args);}
public function parallelCollect(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::parallelCollect',$args);}
public function reduce(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::reduce',$args);}
public function inject(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::inject',$args);}
public function foldl(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::foldl',$args);}
public function reduceRight(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::reduceRight',$args);}
public function foldr(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::foldr',$args);}
public function find(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::find',$args);}
public function detect(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::detect',$args);}
public function findSafe(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::findSafe',$args);}
public function detectSafe(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::detectSafe',$args);}
public function filter(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::filter',$args);}
public function select(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::select',$args);}
public function where(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::where',$args);}
public function findWhere(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::findWhere',$args);}
public function findWhereSafe(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::findWhereSafe',$args);}
public function reject(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::reject',$args);}
public function every(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::every',$args);}
public function all(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::all',$args);}
public function some(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::some',$args);}
public function any(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::any',$args);}
public function sum(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::sum',$args);}
public function product(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::product',$args);}
public function contains(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::contains',$args);}
public function invoke(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::invoke',$args);}
public function pluck(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::pluck',$args);}
public function max(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::max',$args);}
public function min(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::min',$args);}
public function sortBy(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::sortBy',$args);}
public function groupBy(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::groupBy',$args);}
public function countBy(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::countBy',$args);}
public function shuffle(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::shuffle',$args);}
public function toArray(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::toArray',$args);}
public function size(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::size',$args);}
public function index(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::index',$args);}
public function indexSafe(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::indexSafe',$args);}
public function span(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::span',$args);}
public function first(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::first',$args);}
public function head(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::head',$args);}
public function take(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::take',$args);}
public function firstSafe(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::firstSafe',$args);}
public function headSafe(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::headSafe',$args);}
public function takeSafe(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::takeSafe',$args);}
public function takeWhile(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::takeWhile',$args);}
public function initial(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::initial',$args);}
public function last(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::last',$args);}
public function lastSafe(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::lastSafe',$args);}
public function rest(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::rest',$args);}
public function tail(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::tail',$args);}
public function drop(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::drop',$args);}
public function dropWhile(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::dropWhile',$args);}
public function compact(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::compact',$args);}
public function flatten(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::flatten',$args);}
public function without(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::without',$args);}
public function union(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::union',$args);}
public function difference(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::difference',$args);}
public function uniq(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::uniq',$args);}
public function unique(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::unique',$args);}
public function zip(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::zip',$args);}
public function zipWith(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::zipWith',$args);}
public function object(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::object',$args);}
public function indexOf(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::indexOf',$args);}
public function lastIndexOf(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::lastIndexOf',$args);}
public function sortedIndex(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::sortedIndex',$args);}
public function range(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::range',$args);}
public function cycle(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::cycle',$args);}
public function repeat(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::repeat',$args);}
public function iterate(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::iterate',$args);}
public function pop(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::pop',$args);}
public function push(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::push',$args);}
public function reverse(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::reverse',$args);}
public function shift(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::shift',$args);}
public function sort(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::sort',$args);}
public function splice(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::splice',$args);}
public function unshift(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::unshift',$args);}
public function concat(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::concat',$args);}
public function join(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::join',$args);}
public function slice(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::slice',$args);}
public function keys(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::keys',$args);}
public function values(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::values',$args);}
public function pairs(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::pairs',$args);}
public function invert(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::invert',$args);}
public function extend(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::extend',$args);}
public function pick(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::pick',$args);}
public function omit(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::omit',$args);}
public function defaults(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::defaults',$args);}
public function tap(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::tap',$args);}
public function duplicate(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::duplicate',$args);}
public function has(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::has',$args);}
public function isArray(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::isArray',$args);}
public function isTraversable(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::isTraversable',$args);}
public function chain(){$args=func_get_args();array_unshift($args,$this);return call_user_func_array('Underbar\Lazy::chain',$args);}
}
