<?php

if (!class_exists('DbArgenper')) {

    require_once 'ArAccess_db.php';

    class DbArgenper
    {

        private static $_lastQuery;
        private static $_lastParams;
        private static $_cache = array();
        private static $_objInstance;

        /**
         * Returns DB instance or create initial connection
         * @param
         * @return PDO;
         */
        public static function getInstance()
        {
            if (!self::$_objInstance) {
                self::$_objInstance = new PDO('mysql:host=' . DB_MASTER_HOST . ';dbname='.DB_MASTER_NAME, DB_MASTER_USER, DB_MASTER_PASS);
                self::$_objInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }

            return self::$_objInstance;
        }

        public static function queryKeyVal($query, $params = array(), $cache = true)
        {
            self::$_lastQuery = $query;
            self::$_lastParams = $params;
            $hash = 'queryKeyVal@' . $query . md5(print_r($params, TRUE));
            if (isset(self::$_cache[$hash]) && $cache) {
                return self::$_cache[$hash];
            } else {
                if (!is_array($params)) {
                    $params = array($params);
                }
                $stm = self::getInstance()->prepare($query);
                $stm->execute($params);
                
                if ($cache) {
                    self::$_cache[$hash] = $stm->fetchAll(PDO::FETCH_COLUMN | PDO::FETCH_UNIQUE);
                    return self::$_cache[$hash];
                } else {
                    return $stm->fetchAll(PDO::FETCH_COLUMN | PDO::FETCH_UNIQUE);
                }
            }
        }

        public static function queryKeyArray($query, $params = array(), $cache = true)
        {
            self::$_lastQuery = $query;
            self::$_lastParams = $params;
            $hash = 'queryKeyArray@' . $query . md5(print_r($params, TRUE));
            if (isset(self::$_cache[$hash]) && $cache) {
                return self::$_cache[$hash];
            } else {
                if (!is_array($params)) {
                    $params = array($params);
                }
                $stm = self::getInstance()->prepare($query);
                $stm->execute($params);
                
                if ($cache) {
                    self::$_cache[$hash] = $stm->fetchAll(PDO::FETCH_ASSOC | PDO::FETCH_UNIQUE);
                    return self::$_cache[$hash];
                } else {
                    return $stm->fetchAll(PDO::FETCH_ASSOC | PDO::FETCH_UNIQUE);
                }
            }
        }

        public static function queryKeyGroup($query, $params = array(), $cache = true)
        {
            self::$_lastQuery = $query;
            self::$_lastParams = $params;
            $hash = 'queryKeyGroup@' . $query . md5(print_r($params, TRUE));
            if (isset(self::$_cache[$hash]) && $cache) {
                return self::$_cache[$hash];
            } else {
                if (!is_array($params)) {
                    $params = array($params);
                }
                $stm = self::getInstance()->prepare($query);
                $stm->execute($params);
                
                if ($cache) {
                    self::$_cache[$hash] = $stm->fetchAll(PDO::FETCH_ASSOC | PDO::FETCH_GROUP);
                    return self::$_cache[$hash];
                } else {
                    return $stm->fetchAll(PDO::FETCH_ASSOC | PDO::FETCH_GROUP);
                }
            }
        }

        public static function fetchOne($query, $params = array(), $cache = true)
        {
            self::$_lastQuery = $query;
            self::$_lastParams = $params;
            $hash = 'fetchOne@' . $query . md5(print_r($params, TRUE));
            if (isset(self::$_cache[$hash]) && $cache) {
                return self::$_cache[$hash];
            } else {
                if (!is_array($params)) {
                    $params = array($params);
                }
                $stm = self::getInstance()->prepare($query);
                $stm->execute($params);
                
                if ($cache) {
                    self::$_cache[$hash] = $stm->fetch(PDO::FETCH_ASSOC);
                    return self::$_cache[$hash];
                } else {
                    return $stm->fetch(PDO::FETCH_ASSOC);
                }
            }
        }

        public static function fetchAll($query, $params = array(), $cache = true)
        {
            self::$_lastQuery = $query;
            self::$_lastParams = $params;
            $hash = 'fetchAll@' . $query . md5(print_r($params, TRUE));
            if (isset(self::$_cache[$hash]) && $cache) {
                return self::$_cache[$hash];
            } else {
                if (!is_array($params)) {
                    $params = array($params);
                }
                $stm = self::getInstance()->prepare($query);
                $stm->execute($params);
                
                if ($cache) {
                    self::$_cache[$hash] = $stm->fetchAll(PDO::FETCH_ASSOC);
                    return self::$_cache[$hash];
                } else {
                    return $stm->fetchAll(PDO::FETCH_ASSOC);
                }
            }
        }

        public static function exec($query, $params = array())
        {
            self::$_lastQuery = $query;
            self::$_lastParams = $params;
            if (!is_array($params)) {
                $params = array($params);
            }
            $stm = self::getInstance()->prepare($query);
            
            return $stm->execute($params);
        }

        public static function fetchBy($where, $table, $orderby = null, $limit = null, $params = array())
        {
            return self::fetchAll(self::_prepareSelectSimple($where, $table, $orderby, $limit), $params);
        }

        public static function fetchOneBy($where, $table, $orderby = null, $params = array(), $cache = true)
        {
            return self::fetchOne(self::_prepareSelectSimple($where, $table, $orderby, 1), $params, $cache);
        }

        private static function _prepareSelectSimple($where, $table, $orderby = null, $limit = null)
        {
            $query = "SELECT * FROM $table"
                    . self::_prepareWhere($where)
                    . self::_prepareOrderBy($orderby)
                    . self::_prepareLimit($limit);
            return $query;
        }

        private static function _prepareWhere($where)
        {
            if (is_string($where)) {
                $where = array($where);
            }

            if (is_array($where)) {
                return ' WHERE ' . implode(' AND ', $where);
            }
            return '';
        }

        private static function _prepareOrderBy($orderby)
        {
            if (is_string($orderby)) {
                $orderby = array($orderby);
            }

            if (is_array($orderby)) {
                return ' ORDER BY ' . implode(' , ', $orderby);
            }
            return '';
        }

        private static function _prepareLimit($limit)
        {
            if ((int) $limit > 0) {
                return ' LIMIT ' . $limit;
            }

            return '';
        }

        private static function _prepareName($name)
        {
            return "`" . str_replace('`', '', $name) . "`";
        }

        public static function insert($table, array $params)
        {
            $table = self::_prepareName($table);

            $columns = array();
            $paramsValue = array();
            $values = array();
            foreach ($params as $column => $value) {
                $columns[] = self::_prepareName($column);
                if (is_array($value)) {
                    if (!key_exists('value', $value)) {
                        throw new Exception('invalid param insert');
                    }
                    if (key_exists('tagAllow', $value)) {
                        $paramsValue[] = $value['value'];
                    } else {
                        $paramsValue[] = strip_tags($value['value']);
                    }    
                } else {
                    $paramsValue[] = strip_tags($value);
                }    
                $values[] = '?';
            }
            $query = "INSERT INTO $table (" . implode(',', $columns) . ")"
                    . " VALUES (" . implode(',', $values) . ")";

            self::$_lastQuery = $query;
            self::$_lastParams = $paramsValue;

            $stm = self::getInstance()->prepare($query);
            $stm->execute($paramsValue);

            return self::getInstance()->lastInsertId($table);
        }

        public static function update($table, array $params, $where = null, $paramsWhere = array())
        {
            if (count($params) == 0) {
                return false;
            }
            
            $table = self::_prepareName($table);

            $paramsValue = array();
            $columns = array();
            foreach ($params as $column => $value) {
                $columns[] = self::_prepareName($column) . ' = ?';
                if (is_array($value)) {
                    if (!key_exists('value', $value)) {
                        throw new Exception('invalid param update');
                    }
                    if (key_exists('tagAllow', $value)) {
                        $paramsValue[] = $value['value'];
                    } else {
                        $paramsValue[] = strip_tags($value['value']);
                    }    
                } else {
                    $paramsValue[] = strip_tags($value);
                } 
            }

            if (!is_array($paramsWhere)) {
                $paramsWhere = array($paramsWhere);
            }
            foreach ($paramsWhere as $value) {
                $paramsValue[] = $value;
            }
            
            $query = "UPDATE $table"
                    . " SET " . implode(',', $columns)
                    . self::_prepareWhere($where);

            self::$_lastQuery = $query;
            self::$_lastParams = $paramsValue;
            
            $stm = self::getInstance()->prepare($query);
            return $stm->execute($paramsValue);
        }

        public static function getCache()
        {
            return self::$_cache;
        }

        public static function getLastQuery()
        {
            return self::$_lastQuery;
        }
        
        public static function getLastParams()
        {
            return self::$_lastParams;
        }

    }

}