<?php

namespace EcclesiaCRM\Base;

use \Exception;
use \PDO;
use EcclesiaCRM\Cards as ChildCards;
use EcclesiaCRM\CardsQuery as ChildCardsQuery;
use EcclesiaCRM\Map\CardsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'cards' table.
 *
 *
 *
 * @method     ChildCardsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCardsQuery orderByAddressbookid($order = Criteria::ASC) Order by the addressbookid column
 * @method     ChildCardsQuery orderByCarddata($order = Criteria::ASC) Order by the carddata column
 * @method     ChildCardsQuery orderByUri($order = Criteria::ASC) Order by the uri column
 * @method     ChildCardsQuery orderByLastmodified($order = Criteria::ASC) Order by the lastmodified column
 * @method     ChildCardsQuery orderByEtag($order = Criteria::ASC) Order by the etag column
 * @method     ChildCardsQuery orderBySize($order = Criteria::ASC) Order by the size column
 *
 * @method     ChildCardsQuery groupById() Group by the id column
 * @method     ChildCardsQuery groupByAddressbookid() Group by the addressbookid column
 * @method     ChildCardsQuery groupByCarddata() Group by the carddata column
 * @method     ChildCardsQuery groupByUri() Group by the uri column
 * @method     ChildCardsQuery groupByLastmodified() Group by the lastmodified column
 * @method     ChildCardsQuery groupByEtag() Group by the etag column
 * @method     ChildCardsQuery groupBySize() Group by the size column
 *
 * @method     ChildCardsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCardsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCardsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCardsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCardsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCardsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCardsQuery leftJoinAddressbooks($relationAlias = null) Adds a LEFT JOIN clause to the query using the Addressbooks relation
 * @method     ChildCardsQuery rightJoinAddressbooks($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Addressbooks relation
 * @method     ChildCardsQuery innerJoinAddressbooks($relationAlias = null) Adds a INNER JOIN clause to the query using the Addressbooks relation
 *
 * @method     ChildCardsQuery joinWithAddressbooks($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Addressbooks relation
 *
 * @method     ChildCardsQuery leftJoinWithAddressbooks() Adds a LEFT JOIN clause and with to the query using the Addressbooks relation
 * @method     ChildCardsQuery rightJoinWithAddressbooks() Adds a RIGHT JOIN clause and with to the query using the Addressbooks relation
 * @method     ChildCardsQuery innerJoinWithAddressbooks() Adds a INNER JOIN clause and with to the query using the Addressbooks relation
 *
 * @method     \EcclesiaCRM\AddressbooksQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCards findOne(ConnectionInterface $con = null) Return the first ChildCards matching the query
 * @method     ChildCards findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCards matching the query, or a new ChildCards object populated from the query conditions when no match is found
 *
 * @method     ChildCards findOneById(int $id) Return the first ChildCards filtered by the id column
 * @method     ChildCards findOneByAddressbookid(int $addressbookid) Return the first ChildCards filtered by the addressbookid column
 * @method     ChildCards findOneByCarddata(string $carddata) Return the first ChildCards filtered by the carddata column
 * @method     ChildCards findOneByUri(string $uri) Return the first ChildCards filtered by the uri column
 * @method     ChildCards findOneByLastmodified(int $lastmodified) Return the first ChildCards filtered by the lastmodified column
 * @method     ChildCards findOneByEtag(string $etag) Return the first ChildCards filtered by the etag column
 * @method     ChildCards findOneBySize(int $size) Return the first ChildCards filtered by the size column *

 * @method     ChildCards requirePk($key, ConnectionInterface $con = null) Return the ChildCards by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCards requireOne(ConnectionInterface $con = null) Return the first ChildCards matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCards requireOneById(int $id) Return the first ChildCards filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCards requireOneByAddressbookid(int $addressbookid) Return the first ChildCards filtered by the addressbookid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCards requireOneByCarddata(string $carddata) Return the first ChildCards filtered by the carddata column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCards requireOneByUri(string $uri) Return the first ChildCards filtered by the uri column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCards requireOneByLastmodified(int $lastmodified) Return the first ChildCards filtered by the lastmodified column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCards requireOneByEtag(string $etag) Return the first ChildCards filtered by the etag column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCards requireOneBySize(int $size) Return the first ChildCards filtered by the size column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCards[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCards objects based on current ModelCriteria
 * @method     ChildCards[]|ObjectCollection findById(int $id) Return ChildCards objects filtered by the id column
 * @method     ChildCards[]|ObjectCollection findByAddressbookid(int $addressbookid) Return ChildCards objects filtered by the addressbookid column
 * @method     ChildCards[]|ObjectCollection findByCarddata(string $carddata) Return ChildCards objects filtered by the carddata column
 * @method     ChildCards[]|ObjectCollection findByUri(string $uri) Return ChildCards objects filtered by the uri column
 * @method     ChildCards[]|ObjectCollection findByLastmodified(int $lastmodified) Return ChildCards objects filtered by the lastmodified column
 * @method     ChildCards[]|ObjectCollection findByEtag(string $etag) Return ChildCards objects filtered by the etag column
 * @method     ChildCards[]|ObjectCollection findBySize(int $size) Return ChildCards objects filtered by the size column
 * @method     ChildCards[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CardsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \EcclesiaCRM\Base\CardsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\EcclesiaCRM\\Cards', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCardsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCardsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCardsQuery) {
            return $criteria;
        }
        $query = new ChildCardsQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildCards|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CardsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CardsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCards A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, addressbookid, carddata, uri, lastmodified, etag, size FROM cards WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildCards $obj */
            $obj = new ChildCards();
            $obj->hydrate($row);
            CardsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildCards|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildCardsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CardsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCardsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CardsTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCardsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CardsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CardsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CardsTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the addressbookid column
     *
     * Example usage:
     * <code>
     * $query->filterByAddressbookid(1234); // WHERE addressbookid = 1234
     * $query->filterByAddressbookid(array(12, 34)); // WHERE addressbookid IN (12, 34)
     * $query->filterByAddressbookid(array('min' => 12)); // WHERE addressbookid > 12
     * </code>
     *
     * @see       filterByAddressbooks()
     *
     * @param     mixed $addressbookid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCardsQuery The current query, for fluid interface
     */
    public function filterByAddressbookid($addressbookid = null, $comparison = null)
    {
        if (is_array($addressbookid)) {
            $useMinMax = false;
            if (isset($addressbookid['min'])) {
                $this->addUsingAlias(CardsTableMap::COL_ADDRESSBOOKID, $addressbookid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($addressbookid['max'])) {
                $this->addUsingAlias(CardsTableMap::COL_ADDRESSBOOKID, $addressbookid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CardsTableMap::COL_ADDRESSBOOKID, $addressbookid, $comparison);
    }

    /**
     * Filter the query on the carddata column
     *
     * @param     mixed $carddata The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCardsQuery The current query, for fluid interface
     */
    public function filterByCarddata($carddata = null, $comparison = null)
    {

        return $this->addUsingAlias(CardsTableMap::COL_CARDDATA, $carddata, $comparison);
    }

    /**
     * Filter the query on the uri column
     *
     * Example usage:
     * <code>
     * $query->filterByUri('fooValue');   // WHERE uri = 'fooValue'
     * $query->filterByUri('%fooValue%', Criteria::LIKE); // WHERE uri LIKE '%fooValue%'
     * </code>
     *
     * @param     string $uri The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCardsQuery The current query, for fluid interface
     */
    public function filterByUri($uri = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uri)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CardsTableMap::COL_URI, $uri, $comparison);
    }

    /**
     * Filter the query on the lastmodified column
     *
     * Example usage:
     * <code>
     * $query->filterByLastmodified(1234); // WHERE lastmodified = 1234
     * $query->filterByLastmodified(array(12, 34)); // WHERE lastmodified IN (12, 34)
     * $query->filterByLastmodified(array('min' => 12)); // WHERE lastmodified > 12
     * </code>
     *
     * @param     mixed $lastmodified The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCardsQuery The current query, for fluid interface
     */
    public function filterByLastmodified($lastmodified = null, $comparison = null)
    {
        if (is_array($lastmodified)) {
            $useMinMax = false;
            if (isset($lastmodified['min'])) {
                $this->addUsingAlias(CardsTableMap::COL_LASTMODIFIED, $lastmodified['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastmodified['max'])) {
                $this->addUsingAlias(CardsTableMap::COL_LASTMODIFIED, $lastmodified['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CardsTableMap::COL_LASTMODIFIED, $lastmodified, $comparison);
    }

    /**
     * Filter the query on the etag column
     *
     * Example usage:
     * <code>
     * $query->filterByEtag('fooValue');   // WHERE etag = 'fooValue'
     * $query->filterByEtag('%fooValue%', Criteria::LIKE); // WHERE etag LIKE '%fooValue%'
     * </code>
     *
     * @param     string $etag The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCardsQuery The current query, for fluid interface
     */
    public function filterByEtag($etag = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($etag)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CardsTableMap::COL_ETAG, $etag, $comparison);
    }

    /**
     * Filter the query on the size column
     *
     * Example usage:
     * <code>
     * $query->filterBySize(1234); // WHERE size = 1234
     * $query->filterBySize(array(12, 34)); // WHERE size IN (12, 34)
     * $query->filterBySize(array('min' => 12)); // WHERE size > 12
     * </code>
     *
     * @param     mixed $size The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCardsQuery The current query, for fluid interface
     */
    public function filterBySize($size = null, $comparison = null)
    {
        if (is_array($size)) {
            $useMinMax = false;
            if (isset($size['min'])) {
                $this->addUsingAlias(CardsTableMap::COL_SIZE, $size['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($size['max'])) {
                $this->addUsingAlias(CardsTableMap::COL_SIZE, $size['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CardsTableMap::COL_SIZE, $size, $comparison);
    }

    /**
     * Filter the query by a related \EcclesiaCRM\Addressbooks object
     *
     * @param \EcclesiaCRM\Addressbooks|ObjectCollection $addressbooks The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCardsQuery The current query, for fluid interface
     */
    public function filterByAddressbooks($addressbooks, $comparison = null)
    {
        if ($addressbooks instanceof \EcclesiaCRM\Addressbooks) {
            return $this
                ->addUsingAlias(CardsTableMap::COL_ADDRESSBOOKID, $addressbooks->getId(), $comparison);
        } elseif ($addressbooks instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CardsTableMap::COL_ADDRESSBOOKID, $addressbooks->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByAddressbooks() only accepts arguments of type \EcclesiaCRM\Addressbooks or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Addressbooks relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCardsQuery The current query, for fluid interface
     */
    public function joinAddressbooks($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Addressbooks');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Addressbooks');
        }

        return $this;
    }

    /**
     * Use the Addressbooks relation Addressbooks object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EcclesiaCRM\AddressbooksQuery A secondary query class using the current class as primary query
     */
    public function useAddressbooksQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAddressbooks($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Addressbooks', '\EcclesiaCRM\AddressbooksQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCards $cards Object to remove from the list of results
     *
     * @return $this|ChildCardsQuery The current query, for fluid interface
     */
    public function prune($cards = null)
    {
        if ($cards) {
            $this->addUsingAlias(CardsTableMap::COL_ID, $cards->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the cards table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CardsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CardsTableMap::clearInstancePool();
            CardsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CardsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CardsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CardsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CardsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CardsQuery
