<?php

namespace EcclesiaCRM\Base;

use \Exception;
use \PDO;
use EcclesiaCRM\EventCountName as ChildEventCountName;
use EcclesiaCRM\EventCountNameQuery as ChildEventCountNameQuery;
use EcclesiaCRM\Map\EventCountNameTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'eventcountnames_evctnm' table.
 *
 *
 *
 * @method     ChildEventCountNameQuery orderById($order = Criteria::ASC) Order by the evctnm_countid column
 * @method     ChildEventCountNameQuery orderByTypeId($order = Criteria::ASC) Order by the evctnm_eventtypeid column
 * @method     ChildEventCountNameQuery orderByName($order = Criteria::ASC) Order by the evctnm_countname column
 * @method     ChildEventCountNameQuery orderByNotes($order = Criteria::ASC) Order by the evctnm_notes column
 *
 * @method     ChildEventCountNameQuery groupById() Group by the evctnm_countid column
 * @method     ChildEventCountNameQuery groupByTypeId() Group by the evctnm_eventtypeid column
 * @method     ChildEventCountNameQuery groupByName() Group by the evctnm_countname column
 * @method     ChildEventCountNameQuery groupByNotes() Group by the evctnm_notes column
 *
 * @method     ChildEventCountNameQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEventCountNameQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEventCountNameQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEventCountNameQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEventCountNameQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEventCountNameQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEventCountNameQuery leftJoinEventTypes($relationAlias = null) Adds a LEFT JOIN clause to the query using the EventTypes relation
 * @method     ChildEventCountNameQuery rightJoinEventTypes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EventTypes relation
 * @method     ChildEventCountNameQuery innerJoinEventTypes($relationAlias = null) Adds a INNER JOIN clause to the query using the EventTypes relation
 *
 * @method     ChildEventCountNameQuery joinWithEventTypes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EventTypes relation
 *
 * @method     ChildEventCountNameQuery leftJoinWithEventTypes() Adds a LEFT JOIN clause and with to the query using the EventTypes relation
 * @method     ChildEventCountNameQuery rightJoinWithEventTypes() Adds a RIGHT JOIN clause and with to the query using the EventTypes relation
 * @method     ChildEventCountNameQuery innerJoinWithEventTypes() Adds a INNER JOIN clause and with to the query using the EventTypes relation
 *
 * @method     ChildEventCountNameQuery leftJoinEventCounts($relationAlias = null) Adds a LEFT JOIN clause to the query using the EventCounts relation
 * @method     ChildEventCountNameQuery rightJoinEventCounts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EventCounts relation
 * @method     ChildEventCountNameQuery innerJoinEventCounts($relationAlias = null) Adds a INNER JOIN clause to the query using the EventCounts relation
 *
 * @method     ChildEventCountNameQuery joinWithEventCounts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EventCounts relation
 *
 * @method     ChildEventCountNameQuery leftJoinWithEventCounts() Adds a LEFT JOIN clause and with to the query using the EventCounts relation
 * @method     ChildEventCountNameQuery rightJoinWithEventCounts() Adds a RIGHT JOIN clause and with to the query using the EventCounts relation
 * @method     ChildEventCountNameQuery innerJoinWithEventCounts() Adds a INNER JOIN clause and with to the query using the EventCounts relation
 *
 * @method     \EcclesiaCRM\EventTypesQuery|\EcclesiaCRM\EventCountsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEventCountName findOne(ConnectionInterface $con = null) Return the first ChildEventCountName matching the query
 * @method     ChildEventCountName findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEventCountName matching the query, or a new ChildEventCountName object populated from the query conditions when no match is found
 *
 * @method     ChildEventCountName findOneById(int $evctnm_countid) Return the first ChildEventCountName filtered by the evctnm_countid column
 * @method     ChildEventCountName findOneByTypeId(int $evctnm_eventtypeid) Return the first ChildEventCountName filtered by the evctnm_eventtypeid column
 * @method     ChildEventCountName findOneByName(string $evctnm_countname) Return the first ChildEventCountName filtered by the evctnm_countname column
 * @method     ChildEventCountName findOneByNotes(string $evctnm_notes) Return the first ChildEventCountName filtered by the evctnm_notes column *

 * @method     ChildEventCountName requirePk($key, ConnectionInterface $con = null) Return the ChildEventCountName by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEventCountName requireOne(ConnectionInterface $con = null) Return the first ChildEventCountName matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEventCountName requireOneById(int $evctnm_countid) Return the first ChildEventCountName filtered by the evctnm_countid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEventCountName requireOneByTypeId(int $evctnm_eventtypeid) Return the first ChildEventCountName filtered by the evctnm_eventtypeid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEventCountName requireOneByName(string $evctnm_countname) Return the first ChildEventCountName filtered by the evctnm_countname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEventCountName requireOneByNotes(string $evctnm_notes) Return the first ChildEventCountName filtered by the evctnm_notes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEventCountName[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEventCountName objects based on current ModelCriteria
 * @method     ChildEventCountName[]|ObjectCollection findById(int $evctnm_countid) Return ChildEventCountName objects filtered by the evctnm_countid column
 * @method     ChildEventCountName[]|ObjectCollection findByTypeId(int $evctnm_eventtypeid) Return ChildEventCountName objects filtered by the evctnm_eventtypeid column
 * @method     ChildEventCountName[]|ObjectCollection findByName(string $evctnm_countname) Return ChildEventCountName objects filtered by the evctnm_countname column
 * @method     ChildEventCountName[]|ObjectCollection findByNotes(string $evctnm_notes) Return ChildEventCountName objects filtered by the evctnm_notes column
 * @method     ChildEventCountName[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EventCountNameQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \EcclesiaCRM\Base\EventCountNameQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\EcclesiaCRM\\EventCountName', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEventCountNameQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEventCountNameQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEventCountNameQuery) {
            return $criteria;
        }
        $query = new ChildEventCountNameQuery();
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
     * @return ChildEventCountName|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EventCountNameTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EventCountNameTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEventCountName A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT evctnm_countid, evctnm_eventtypeid, evctnm_countname, evctnm_notes FROM eventcountnames_evctnm WHERE evctnm_countid = :p0';
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
            /** @var ChildEventCountName $obj */
            $obj = new ChildEventCountName();
            $obj->hydrate($row);
            EventCountNameTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEventCountName|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildEventCountNameQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EventCountNameTableMap::COL_EVCTNM_COUNTID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEventCountNameQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EventCountNameTableMap::COL_EVCTNM_COUNTID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the evctnm_countid column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE evctnm_countid = 1234
     * $query->filterById(array(12, 34)); // WHERE evctnm_countid IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE evctnm_countid > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventCountNameQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(EventCountNameTableMap::COL_EVCTNM_COUNTID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(EventCountNameTableMap::COL_EVCTNM_COUNTID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventCountNameTableMap::COL_EVCTNM_COUNTID, $id, $comparison);
    }

    /**
     * Filter the query on the evctnm_eventtypeid column
     *
     * Example usage:
     * <code>
     * $query->filterByTypeId(1234); // WHERE evctnm_eventtypeid = 1234
     * $query->filterByTypeId(array(12, 34)); // WHERE evctnm_eventtypeid IN (12, 34)
     * $query->filterByTypeId(array('min' => 12)); // WHERE evctnm_eventtypeid > 12
     * </code>
     *
     * @see       filterByEventTypes()
     *
     * @param     mixed $typeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventCountNameQuery The current query, for fluid interface
     */
    public function filterByTypeId($typeId = null, $comparison = null)
    {
        if (is_array($typeId)) {
            $useMinMax = false;
            if (isset($typeId['min'])) {
                $this->addUsingAlias(EventCountNameTableMap::COL_EVCTNM_EVENTTYPEID, $typeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($typeId['max'])) {
                $this->addUsingAlias(EventCountNameTableMap::COL_EVCTNM_EVENTTYPEID, $typeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventCountNameTableMap::COL_EVCTNM_EVENTTYPEID, $typeId, $comparison);
    }

    /**
     * Filter the query on the evctnm_countname column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE evctnm_countname = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE evctnm_countname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventCountNameQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventCountNameTableMap::COL_EVCTNM_COUNTNAME, $name, $comparison);
    }

    /**
     * Filter the query on the evctnm_notes column
     *
     * Example usage:
     * <code>
     * $query->filterByNotes('fooValue');   // WHERE evctnm_notes = 'fooValue'
     * $query->filterByNotes('%fooValue%', Criteria::LIKE); // WHERE evctnm_notes LIKE '%fooValue%'
     * </code>
     *
     * @param     string $notes The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventCountNameQuery The current query, for fluid interface
     */
    public function filterByNotes($notes = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($notes)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventCountNameTableMap::COL_EVCTNM_NOTES, $notes, $comparison);
    }

    /**
     * Filter the query by a related \EcclesiaCRM\EventTypes object
     *
     * @param \EcclesiaCRM\EventTypes|ObjectCollection $eventTypes The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEventCountNameQuery The current query, for fluid interface
     */
    public function filterByEventTypes($eventTypes, $comparison = null)
    {
        if ($eventTypes instanceof \EcclesiaCRM\EventTypes) {
            return $this
                ->addUsingAlias(EventCountNameTableMap::COL_EVCTNM_EVENTTYPEID, $eventTypes->getId(), $comparison);
        } elseif ($eventTypes instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EventCountNameTableMap::COL_EVCTNM_EVENTTYPEID, $eventTypes->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByEventTypes() only accepts arguments of type \EcclesiaCRM\EventTypes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EventTypes relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEventCountNameQuery The current query, for fluid interface
     */
    public function joinEventTypes($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EventTypes');

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
            $this->addJoinObject($join, 'EventTypes');
        }

        return $this;
    }

    /**
     * Use the EventTypes relation EventTypes object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EcclesiaCRM\EventTypesQuery A secondary query class using the current class as primary query
     */
    public function useEventTypesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEventTypes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EventTypes', '\EcclesiaCRM\EventTypesQuery');
    }

    /**
     * Filter the query by a related \EcclesiaCRM\EventCounts object
     *
     * @param \EcclesiaCRM\EventCounts|ObjectCollection $eventCounts the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEventCountNameQuery The current query, for fluid interface
     */
    public function filterByEventCounts($eventCounts, $comparison = null)
    {
        if ($eventCounts instanceof \EcclesiaCRM\EventCounts) {
            return $this
                ->addUsingAlias(EventCountNameTableMap::COL_EVCTNM_COUNTID, $eventCounts->getEvtcntCountid(), $comparison);
        } elseif ($eventCounts instanceof ObjectCollection) {
            return $this
                ->useEventCountsQuery()
                ->filterByPrimaryKeys($eventCounts->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEventCounts() only accepts arguments of type \EcclesiaCRM\EventCounts or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EventCounts relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEventCountNameQuery The current query, for fluid interface
     */
    public function joinEventCounts($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EventCounts');

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
            $this->addJoinObject($join, 'EventCounts');
        }

        return $this;
    }

    /**
     * Use the EventCounts relation EventCounts object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EcclesiaCRM\EventCountsQuery A secondary query class using the current class as primary query
     */
    public function useEventCountsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEventCounts($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EventCounts', '\EcclesiaCRM\EventCountsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildEventCountName $eventCountName Object to remove from the list of results
     *
     * @return $this|ChildEventCountNameQuery The current query, for fluid interface
     */
    public function prune($eventCountName = null)
    {
        if ($eventCountName) {
            $this->addUsingAlias(EventCountNameTableMap::COL_EVCTNM_COUNTID, $eventCountName->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the eventcountnames_evctnm table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EventCountNameTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EventCountNameTableMap::clearInstancePool();
            EventCountNameTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EventCountNameTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EventCountNameTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EventCountNameTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EventCountNameTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EventCountNameQuery
