<?php

namespace EcclesiaCRM\Base;

use \Exception;
use \PDO;
use EcclesiaCRM\Egive as ChildEgive;
use EcclesiaCRM\EgiveQuery as ChildEgiveQuery;
use EcclesiaCRM\Map\EgiveTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'egive_egv' table.
 *
 *
 *
 * @method     ChildEgiveQuery orderById($order = Criteria::ASC) Order by the egv_ID column
 * @method     ChildEgiveQuery orderByEgiveId($order = Criteria::ASC) Order by the egv_egiveID column
 * @method     ChildEgiveQuery orderByFamId($order = Criteria::ASC) Order by the egv_famID column
 * @method     ChildEgiveQuery orderByDateEntered($order = Criteria::ASC) Order by the egv_DateEntered column
 * @method     ChildEgiveQuery orderByDateLastEdited($order = Criteria::ASC) Order by the egv_DateLastEdited column
 * @method     ChildEgiveQuery orderByEnteredBy($order = Criteria::ASC) Order by the egv_EnteredBy column
 * @method     ChildEgiveQuery orderByEditedBy($order = Criteria::ASC) Order by the egv_EditedBy column
 *
 * @method     ChildEgiveQuery groupById() Group by the egv_ID column
 * @method     ChildEgiveQuery groupByEgiveId() Group by the egv_egiveID column
 * @method     ChildEgiveQuery groupByFamId() Group by the egv_famID column
 * @method     ChildEgiveQuery groupByDateEntered() Group by the egv_DateEntered column
 * @method     ChildEgiveQuery groupByDateLastEdited() Group by the egv_DateLastEdited column
 * @method     ChildEgiveQuery groupByEnteredBy() Group by the egv_EnteredBy column
 * @method     ChildEgiveQuery groupByEditedBy() Group by the egv_EditedBy column
 *
 * @method     ChildEgiveQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEgiveQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEgiveQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEgiveQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEgiveQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEgiveQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEgiveQuery leftJoinFamily($relationAlias = null) Adds a LEFT JOIN clause to the query using the Family relation
 * @method     ChildEgiveQuery rightJoinFamily($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Family relation
 * @method     ChildEgiveQuery innerJoinFamily($relationAlias = null) Adds a INNER JOIN clause to the query using the Family relation
 *
 * @method     ChildEgiveQuery joinWithFamily($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Family relation
 *
 * @method     ChildEgiveQuery leftJoinWithFamily() Adds a LEFT JOIN clause and with to the query using the Family relation
 * @method     ChildEgiveQuery rightJoinWithFamily() Adds a RIGHT JOIN clause and with to the query using the Family relation
 * @method     ChildEgiveQuery innerJoinWithFamily() Adds a INNER JOIN clause and with to the query using the Family relation
 *
 * @method     \EcclesiaCRM\FamilyQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEgive findOne(ConnectionInterface $con = null) Return the first ChildEgive matching the query
 * @method     ChildEgive findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEgive matching the query, or a new ChildEgive object populated from the query conditions when no match is found
 *
 * @method     ChildEgive findOneById(int $egv_ID) Return the first ChildEgive filtered by the egv_ID column
 * @method     ChildEgive findOneByEgiveId(string $egv_egiveID) Return the first ChildEgive filtered by the egv_egiveID column
 * @method     ChildEgive findOneByFamId(int $egv_famID) Return the first ChildEgive filtered by the egv_famID column
 * @method     ChildEgive findOneByDateEntered(string $egv_DateEntered) Return the first ChildEgive filtered by the egv_DateEntered column
 * @method     ChildEgive findOneByDateLastEdited(string $egv_DateLastEdited) Return the first ChildEgive filtered by the egv_DateLastEdited column
 * @method     ChildEgive findOneByEnteredBy(int $egv_EnteredBy) Return the first ChildEgive filtered by the egv_EnteredBy column
 * @method     ChildEgive findOneByEditedBy(int $egv_EditedBy) Return the first ChildEgive filtered by the egv_EditedBy column *

 * @method     ChildEgive requirePk($key, ConnectionInterface $con = null) Return the ChildEgive by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEgive requireOne(ConnectionInterface $con = null) Return the first ChildEgive matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEgive requireOneById(int $egv_ID) Return the first ChildEgive filtered by the egv_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEgive requireOneByEgiveId(string $egv_egiveID) Return the first ChildEgive filtered by the egv_egiveID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEgive requireOneByFamId(int $egv_famID) Return the first ChildEgive filtered by the egv_famID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEgive requireOneByDateEntered(string $egv_DateEntered) Return the first ChildEgive filtered by the egv_DateEntered column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEgive requireOneByDateLastEdited(string $egv_DateLastEdited) Return the first ChildEgive filtered by the egv_DateLastEdited column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEgive requireOneByEnteredBy(int $egv_EnteredBy) Return the first ChildEgive filtered by the egv_EnteredBy column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEgive requireOneByEditedBy(int $egv_EditedBy) Return the first ChildEgive filtered by the egv_EditedBy column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEgive[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEgive objects based on current ModelCriteria
 * @method     ChildEgive[]|ObjectCollection findById(int $egv_ID) Return ChildEgive objects filtered by the egv_ID column
 * @method     ChildEgive[]|ObjectCollection findByEgiveId(string $egv_egiveID) Return ChildEgive objects filtered by the egv_egiveID column
 * @method     ChildEgive[]|ObjectCollection findByFamId(int $egv_famID) Return ChildEgive objects filtered by the egv_famID column
 * @method     ChildEgive[]|ObjectCollection findByDateEntered(string $egv_DateEntered) Return ChildEgive objects filtered by the egv_DateEntered column
 * @method     ChildEgive[]|ObjectCollection findByDateLastEdited(string $egv_DateLastEdited) Return ChildEgive objects filtered by the egv_DateLastEdited column
 * @method     ChildEgive[]|ObjectCollection findByEnteredBy(int $egv_EnteredBy) Return ChildEgive objects filtered by the egv_EnteredBy column
 * @method     ChildEgive[]|ObjectCollection findByEditedBy(int $egv_EditedBy) Return ChildEgive objects filtered by the egv_EditedBy column
 * @method     ChildEgive[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EgiveQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \EcclesiaCRM\Base\EgiveQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\EcclesiaCRM\\Egive', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEgiveQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEgiveQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEgiveQuery) {
            return $criteria;
        }
        $query = new ChildEgiveQuery();
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
     * @return ChildEgive|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EgiveTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EgiveTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEgive A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT egv_ID, egv_egiveID, egv_famID, egv_DateEntered, egv_DateLastEdited, egv_EnteredBy, egv_EditedBy FROM egive_egv WHERE egv_ID = :p0';
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
            /** @var ChildEgive $obj */
            $obj = new ChildEgive();
            $obj->hydrate($row);
            EgiveTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEgive|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildEgiveQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EgiveTableMap::COL_EGV_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEgiveQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EgiveTableMap::COL_EGV_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the egv_ID column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE egv_ID = 1234
     * $query->filterById(array(12, 34)); // WHERE egv_ID IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE egv_ID > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEgiveQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(EgiveTableMap::COL_EGV_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(EgiveTableMap::COL_EGV_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EgiveTableMap::COL_EGV_ID, $id, $comparison);
    }

    /**
     * Filter the query on the egv_egiveID column
     *
     * Example usage:
     * <code>
     * $query->filterByEgiveId('fooValue');   // WHERE egv_egiveID = 'fooValue'
     * $query->filterByEgiveId('%fooValue%', Criteria::LIKE); // WHERE egv_egiveID LIKE '%fooValue%'
     * </code>
     *
     * @param     string $egiveId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEgiveQuery The current query, for fluid interface
     */
    public function filterByEgiveId($egiveId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($egiveId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EgiveTableMap::COL_EGV_EGIVEID, $egiveId, $comparison);
    }

    /**
     * Filter the query on the egv_famID column
     *
     * Example usage:
     * <code>
     * $query->filterByFamId(1234); // WHERE egv_famID = 1234
     * $query->filterByFamId(array(12, 34)); // WHERE egv_famID IN (12, 34)
     * $query->filterByFamId(array('min' => 12)); // WHERE egv_famID > 12
     * </code>
     *
     * @see       filterByFamily()
     *
     * @param     mixed $famId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEgiveQuery The current query, for fluid interface
     */
    public function filterByFamId($famId = null, $comparison = null)
    {
        if (is_array($famId)) {
            $useMinMax = false;
            if (isset($famId['min'])) {
                $this->addUsingAlias(EgiveTableMap::COL_EGV_FAMID, $famId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($famId['max'])) {
                $this->addUsingAlias(EgiveTableMap::COL_EGV_FAMID, $famId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EgiveTableMap::COL_EGV_FAMID, $famId, $comparison);
    }

    /**
     * Filter the query on the egv_DateEntered column
     *
     * Example usage:
     * <code>
     * $query->filterByDateEntered('2011-03-14'); // WHERE egv_DateEntered = '2011-03-14'
     * $query->filterByDateEntered('now'); // WHERE egv_DateEntered = '2011-03-14'
     * $query->filterByDateEntered(array('max' => 'yesterday')); // WHERE egv_DateEntered > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateEntered The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEgiveQuery The current query, for fluid interface
     */
    public function filterByDateEntered($dateEntered = null, $comparison = null)
    {
        if (is_array($dateEntered)) {
            $useMinMax = false;
            if (isset($dateEntered['min'])) {
                $this->addUsingAlias(EgiveTableMap::COL_EGV_DATEENTERED, $dateEntered['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateEntered['max'])) {
                $this->addUsingAlias(EgiveTableMap::COL_EGV_DATEENTERED, $dateEntered['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EgiveTableMap::COL_EGV_DATEENTERED, $dateEntered, $comparison);
    }

    /**
     * Filter the query on the egv_DateLastEdited column
     *
     * Example usage:
     * <code>
     * $query->filterByDateLastEdited('2011-03-14'); // WHERE egv_DateLastEdited = '2011-03-14'
     * $query->filterByDateLastEdited('now'); // WHERE egv_DateLastEdited = '2011-03-14'
     * $query->filterByDateLastEdited(array('max' => 'yesterday')); // WHERE egv_DateLastEdited > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateLastEdited The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEgiveQuery The current query, for fluid interface
     */
    public function filterByDateLastEdited($dateLastEdited = null, $comparison = null)
    {
        if (is_array($dateLastEdited)) {
            $useMinMax = false;
            if (isset($dateLastEdited['min'])) {
                $this->addUsingAlias(EgiveTableMap::COL_EGV_DATELASTEDITED, $dateLastEdited['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateLastEdited['max'])) {
                $this->addUsingAlias(EgiveTableMap::COL_EGV_DATELASTEDITED, $dateLastEdited['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EgiveTableMap::COL_EGV_DATELASTEDITED, $dateLastEdited, $comparison);
    }

    /**
     * Filter the query on the egv_EnteredBy column
     *
     * Example usage:
     * <code>
     * $query->filterByEnteredBy(1234); // WHERE egv_EnteredBy = 1234
     * $query->filterByEnteredBy(array(12, 34)); // WHERE egv_EnteredBy IN (12, 34)
     * $query->filterByEnteredBy(array('min' => 12)); // WHERE egv_EnteredBy > 12
     * </code>
     *
     * @param     mixed $enteredBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEgiveQuery The current query, for fluid interface
     */
    public function filterByEnteredBy($enteredBy = null, $comparison = null)
    {
        if (is_array($enteredBy)) {
            $useMinMax = false;
            if (isset($enteredBy['min'])) {
                $this->addUsingAlias(EgiveTableMap::COL_EGV_ENTEREDBY, $enteredBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($enteredBy['max'])) {
                $this->addUsingAlias(EgiveTableMap::COL_EGV_ENTEREDBY, $enteredBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EgiveTableMap::COL_EGV_ENTEREDBY, $enteredBy, $comparison);
    }

    /**
     * Filter the query on the egv_EditedBy column
     *
     * Example usage:
     * <code>
     * $query->filterByEditedBy(1234); // WHERE egv_EditedBy = 1234
     * $query->filterByEditedBy(array(12, 34)); // WHERE egv_EditedBy IN (12, 34)
     * $query->filterByEditedBy(array('min' => 12)); // WHERE egv_EditedBy > 12
     * </code>
     *
     * @param     mixed $editedBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEgiveQuery The current query, for fluid interface
     */
    public function filterByEditedBy($editedBy = null, $comparison = null)
    {
        if (is_array($editedBy)) {
            $useMinMax = false;
            if (isset($editedBy['min'])) {
                $this->addUsingAlias(EgiveTableMap::COL_EGV_EDITEDBY, $editedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($editedBy['max'])) {
                $this->addUsingAlias(EgiveTableMap::COL_EGV_EDITEDBY, $editedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EgiveTableMap::COL_EGV_EDITEDBY, $editedBy, $comparison);
    }

    /**
     * Filter the query by a related \EcclesiaCRM\Family object
     *
     * @param \EcclesiaCRM\Family|ObjectCollection $family The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEgiveQuery The current query, for fluid interface
     */
    public function filterByFamily($family, $comparison = null)
    {
        if ($family instanceof \EcclesiaCRM\Family) {
            return $this
                ->addUsingAlias(EgiveTableMap::COL_EGV_FAMID, $family->getId(), $comparison);
        } elseif ($family instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EgiveTableMap::COL_EGV_FAMID, $family->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByFamily() only accepts arguments of type \EcclesiaCRM\Family or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Family relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEgiveQuery The current query, for fluid interface
     */
    public function joinFamily($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Family');

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
            $this->addJoinObject($join, 'Family');
        }

        return $this;
    }

    /**
     * Use the Family relation Family object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EcclesiaCRM\FamilyQuery A secondary query class using the current class as primary query
     */
    public function useFamilyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFamily($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Family', '\EcclesiaCRM\FamilyQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildEgive $egive Object to remove from the list of results
     *
     * @return $this|ChildEgiveQuery The current query, for fluid interface
     */
    public function prune($egive = null)
    {
        if ($egive) {
            $this->addUsingAlias(EgiveTableMap::COL_EGV_ID, $egive->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the egive_egv table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EgiveTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EgiveTableMap::clearInstancePool();
            EgiveTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EgiveTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EgiveTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EgiveTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EgiveTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EgiveQuery
