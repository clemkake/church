<?php

namespace EcclesiaCRM\Base;

use \Exception;
use \PDO;
use EcclesiaCRM\PastoralCare as ChildPastoralCare;
use EcclesiaCRM\PastoralCareQuery as ChildPastoralCareQuery;
use EcclesiaCRM\Map\PastoralCareTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'pastoral_care' table.
 *
 *
 *
 * @method     ChildPastoralCareQuery orderById($order = Criteria::ASC) Order by the pst_cr_id column
 * @method     ChildPastoralCareQuery orderByPersonId($order = Criteria::ASC) Order by the pst_cr_person_id column
 * @method     ChildPastoralCareQuery orderByPastorId($order = Criteria::ASC) Order by the pst_cr_pastor_id column
 * @method     ChildPastoralCareQuery orderByPastorName($order = Criteria::ASC) Order by the pst_cr_pastor_Name column
 * @method     ChildPastoralCareQuery orderByTypeId($order = Criteria::ASC) Order by the pst_cr_Type_id column
 * @method     ChildPastoralCareQuery orderByVisible($order = Criteria::ASC) Order by the pst_cr_visible column
 * @method     ChildPastoralCareQuery orderByText($order = Criteria::ASC) Order by the pst_cr_Text column
 * @method     ChildPastoralCareQuery orderByDate($order = Criteria::ASC) Order by the pst_cr_date column
 *
 * @method     ChildPastoralCareQuery groupById() Group by the pst_cr_id column
 * @method     ChildPastoralCareQuery groupByPersonId() Group by the pst_cr_person_id column
 * @method     ChildPastoralCareQuery groupByPastorId() Group by the pst_cr_pastor_id column
 * @method     ChildPastoralCareQuery groupByPastorName() Group by the pst_cr_pastor_Name column
 * @method     ChildPastoralCareQuery groupByTypeId() Group by the pst_cr_Type_id column
 * @method     ChildPastoralCareQuery groupByVisible() Group by the pst_cr_visible column
 * @method     ChildPastoralCareQuery groupByText() Group by the pst_cr_Text column
 * @method     ChildPastoralCareQuery groupByDate() Group by the pst_cr_date column
 *
 * @method     ChildPastoralCareQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPastoralCareQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPastoralCareQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPastoralCareQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPastoralCareQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPastoralCareQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPastoralCareQuery leftJoinPastoralCareType($relationAlias = null) Adds a LEFT JOIN clause to the query using the PastoralCareType relation
 * @method     ChildPastoralCareQuery rightJoinPastoralCareType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PastoralCareType relation
 * @method     ChildPastoralCareQuery innerJoinPastoralCareType($relationAlias = null) Adds a INNER JOIN clause to the query using the PastoralCareType relation
 *
 * @method     ChildPastoralCareQuery joinWithPastoralCareType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PastoralCareType relation
 *
 * @method     ChildPastoralCareQuery leftJoinWithPastoralCareType() Adds a LEFT JOIN clause and with to the query using the PastoralCareType relation
 * @method     ChildPastoralCareQuery rightJoinWithPastoralCareType() Adds a RIGHT JOIN clause and with to the query using the PastoralCareType relation
 * @method     ChildPastoralCareQuery innerJoinWithPastoralCareType() Adds a INNER JOIN clause and with to the query using the PastoralCareType relation
 *
 * @method     ChildPastoralCareQuery leftJoinPersonRelatedByPastorId($relationAlias = null) Adds a LEFT JOIN clause to the query using the PersonRelatedByPastorId relation
 * @method     ChildPastoralCareQuery rightJoinPersonRelatedByPastorId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PersonRelatedByPastorId relation
 * @method     ChildPastoralCareQuery innerJoinPersonRelatedByPastorId($relationAlias = null) Adds a INNER JOIN clause to the query using the PersonRelatedByPastorId relation
 *
 * @method     ChildPastoralCareQuery joinWithPersonRelatedByPastorId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PersonRelatedByPastorId relation
 *
 * @method     ChildPastoralCareQuery leftJoinWithPersonRelatedByPastorId() Adds a LEFT JOIN clause and with to the query using the PersonRelatedByPastorId relation
 * @method     ChildPastoralCareQuery rightJoinWithPersonRelatedByPastorId() Adds a RIGHT JOIN clause and with to the query using the PersonRelatedByPastorId relation
 * @method     ChildPastoralCareQuery innerJoinWithPersonRelatedByPastorId() Adds a INNER JOIN clause and with to the query using the PersonRelatedByPastorId relation
 *
 * @method     ChildPastoralCareQuery leftJoinPersonRelatedByPersonId($relationAlias = null) Adds a LEFT JOIN clause to the query using the PersonRelatedByPersonId relation
 * @method     ChildPastoralCareQuery rightJoinPersonRelatedByPersonId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PersonRelatedByPersonId relation
 * @method     ChildPastoralCareQuery innerJoinPersonRelatedByPersonId($relationAlias = null) Adds a INNER JOIN clause to the query using the PersonRelatedByPersonId relation
 *
 * @method     ChildPastoralCareQuery joinWithPersonRelatedByPersonId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PersonRelatedByPersonId relation
 *
 * @method     ChildPastoralCareQuery leftJoinWithPersonRelatedByPersonId() Adds a LEFT JOIN clause and with to the query using the PersonRelatedByPersonId relation
 * @method     ChildPastoralCareQuery rightJoinWithPersonRelatedByPersonId() Adds a RIGHT JOIN clause and with to the query using the PersonRelatedByPersonId relation
 * @method     ChildPastoralCareQuery innerJoinWithPersonRelatedByPersonId() Adds a INNER JOIN clause and with to the query using the PersonRelatedByPersonId relation
 *
 * @method     \EcclesiaCRM\PastoralCareTypeQuery|\EcclesiaCRM\PersonQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPastoralCare findOne(ConnectionInterface $con = null) Return the first ChildPastoralCare matching the query
 * @method     ChildPastoralCare findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPastoralCare matching the query, or a new ChildPastoralCare object populated from the query conditions when no match is found
 *
 * @method     ChildPastoralCare findOneById(int $pst_cr_id) Return the first ChildPastoralCare filtered by the pst_cr_id column
 * @method     ChildPastoralCare findOneByPersonId(int $pst_cr_person_id) Return the first ChildPastoralCare filtered by the pst_cr_person_id column
 * @method     ChildPastoralCare findOneByPastorId(int $pst_cr_pastor_id) Return the first ChildPastoralCare filtered by the pst_cr_pastor_id column
 * @method     ChildPastoralCare findOneByPastorName(string $pst_cr_pastor_Name) Return the first ChildPastoralCare filtered by the pst_cr_pastor_Name column
 * @method     ChildPastoralCare findOneByTypeId(int $pst_cr_Type_id) Return the first ChildPastoralCare filtered by the pst_cr_Type_id column
 * @method     ChildPastoralCare findOneByVisible(boolean $pst_cr_visible) Return the first ChildPastoralCare filtered by the pst_cr_visible column
 * @method     ChildPastoralCare findOneByText(string $pst_cr_Text) Return the first ChildPastoralCare filtered by the pst_cr_Text column
 * @method     ChildPastoralCare findOneByDate(string $pst_cr_date) Return the first ChildPastoralCare filtered by the pst_cr_date column *

 * @method     ChildPastoralCare requirePk($key, ConnectionInterface $con = null) Return the ChildPastoralCare by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPastoralCare requireOne(ConnectionInterface $con = null) Return the first ChildPastoralCare matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPastoralCare requireOneById(int $pst_cr_id) Return the first ChildPastoralCare filtered by the pst_cr_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPastoralCare requireOneByPersonId(int $pst_cr_person_id) Return the first ChildPastoralCare filtered by the pst_cr_person_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPastoralCare requireOneByPastorId(int $pst_cr_pastor_id) Return the first ChildPastoralCare filtered by the pst_cr_pastor_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPastoralCare requireOneByPastorName(string $pst_cr_pastor_Name) Return the first ChildPastoralCare filtered by the pst_cr_pastor_Name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPastoralCare requireOneByTypeId(int $pst_cr_Type_id) Return the first ChildPastoralCare filtered by the pst_cr_Type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPastoralCare requireOneByVisible(boolean $pst_cr_visible) Return the first ChildPastoralCare filtered by the pst_cr_visible column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPastoralCare requireOneByText(string $pst_cr_Text) Return the first ChildPastoralCare filtered by the pst_cr_Text column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPastoralCare requireOneByDate(string $pst_cr_date) Return the first ChildPastoralCare filtered by the pst_cr_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPastoralCare[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPastoralCare objects based on current ModelCriteria
 * @method     ChildPastoralCare[]|ObjectCollection findById(int $pst_cr_id) Return ChildPastoralCare objects filtered by the pst_cr_id column
 * @method     ChildPastoralCare[]|ObjectCollection findByPersonId(int $pst_cr_person_id) Return ChildPastoralCare objects filtered by the pst_cr_person_id column
 * @method     ChildPastoralCare[]|ObjectCollection findByPastorId(int $pst_cr_pastor_id) Return ChildPastoralCare objects filtered by the pst_cr_pastor_id column
 * @method     ChildPastoralCare[]|ObjectCollection findByPastorName(string $pst_cr_pastor_Name) Return ChildPastoralCare objects filtered by the pst_cr_pastor_Name column
 * @method     ChildPastoralCare[]|ObjectCollection findByTypeId(int $pst_cr_Type_id) Return ChildPastoralCare objects filtered by the pst_cr_Type_id column
 * @method     ChildPastoralCare[]|ObjectCollection findByVisible(boolean $pst_cr_visible) Return ChildPastoralCare objects filtered by the pst_cr_visible column
 * @method     ChildPastoralCare[]|ObjectCollection findByText(string $pst_cr_Text) Return ChildPastoralCare objects filtered by the pst_cr_Text column
 * @method     ChildPastoralCare[]|ObjectCollection findByDate(string $pst_cr_date) Return ChildPastoralCare objects filtered by the pst_cr_date column
 * @method     ChildPastoralCare[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PastoralCareQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \EcclesiaCRM\Base\PastoralCareQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\EcclesiaCRM\\PastoralCare', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPastoralCareQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPastoralCareQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPastoralCareQuery) {
            return $criteria;
        }
        $query = new ChildPastoralCareQuery();
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
     * @return ChildPastoralCare|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PastoralCareTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PastoralCareTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPastoralCare A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT pst_cr_id, pst_cr_person_id, pst_cr_pastor_id, pst_cr_pastor_Name, pst_cr_Type_id, pst_cr_visible, pst_cr_Text, pst_cr_date FROM pastoral_care WHERE pst_cr_id = :p0';
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
            /** @var ChildPastoralCare $obj */
            $obj = new ChildPastoralCare();
            $obj->hydrate($row);
            PastoralCareTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPastoralCare|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPastoralCareQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PastoralCareTableMap::COL_PST_CR_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPastoralCareQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PastoralCareTableMap::COL_PST_CR_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the pst_cr_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE pst_cr_id = 1234
     * $query->filterById(array(12, 34)); // WHERE pst_cr_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE pst_cr_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPastoralCareQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PastoralCareTableMap::COL_PST_CR_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PastoralCareTableMap::COL_PST_CR_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PastoralCareTableMap::COL_PST_CR_ID, $id, $comparison);
    }

    /**
     * Filter the query on the pst_cr_person_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPersonId(1234); // WHERE pst_cr_person_id = 1234
     * $query->filterByPersonId(array(12, 34)); // WHERE pst_cr_person_id IN (12, 34)
     * $query->filterByPersonId(array('min' => 12)); // WHERE pst_cr_person_id > 12
     * </code>
     *
     * @see       filterByPersonRelatedByPersonId()
     *
     * @param     mixed $personId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPastoralCareQuery The current query, for fluid interface
     */
    public function filterByPersonId($personId = null, $comparison = null)
    {
        if (is_array($personId)) {
            $useMinMax = false;
            if (isset($personId['min'])) {
                $this->addUsingAlias(PastoralCareTableMap::COL_PST_CR_PERSON_ID, $personId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($personId['max'])) {
                $this->addUsingAlias(PastoralCareTableMap::COL_PST_CR_PERSON_ID, $personId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PastoralCareTableMap::COL_PST_CR_PERSON_ID, $personId, $comparison);
    }

    /**
     * Filter the query on the pst_cr_pastor_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPastorId(1234); // WHERE pst_cr_pastor_id = 1234
     * $query->filterByPastorId(array(12, 34)); // WHERE pst_cr_pastor_id IN (12, 34)
     * $query->filterByPastorId(array('min' => 12)); // WHERE pst_cr_pastor_id > 12
     * </code>
     *
     * @see       filterByPersonRelatedByPastorId()
     *
     * @param     mixed $pastorId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPastoralCareQuery The current query, for fluid interface
     */
    public function filterByPastorId($pastorId = null, $comparison = null)
    {
        if (is_array($pastorId)) {
            $useMinMax = false;
            if (isset($pastorId['min'])) {
                $this->addUsingAlias(PastoralCareTableMap::COL_PST_CR_PASTOR_ID, $pastorId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pastorId['max'])) {
                $this->addUsingAlias(PastoralCareTableMap::COL_PST_CR_PASTOR_ID, $pastorId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PastoralCareTableMap::COL_PST_CR_PASTOR_ID, $pastorId, $comparison);
    }

    /**
     * Filter the query on the pst_cr_pastor_Name column
     *
     * Example usage:
     * <code>
     * $query->filterByPastorName('fooValue');   // WHERE pst_cr_pastor_Name = 'fooValue'
     * $query->filterByPastorName('%fooValue%', Criteria::LIKE); // WHERE pst_cr_pastor_Name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pastorName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPastoralCareQuery The current query, for fluid interface
     */
    public function filterByPastorName($pastorName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pastorName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PastoralCareTableMap::COL_PST_CR_PASTOR_NAME, $pastorName, $comparison);
    }

    /**
     * Filter the query on the pst_cr_Type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTypeId(1234); // WHERE pst_cr_Type_id = 1234
     * $query->filterByTypeId(array(12, 34)); // WHERE pst_cr_Type_id IN (12, 34)
     * $query->filterByTypeId(array('min' => 12)); // WHERE pst_cr_Type_id > 12
     * </code>
     *
     * @see       filterByPastoralCareType()
     *
     * @param     mixed $typeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPastoralCareQuery The current query, for fluid interface
     */
    public function filterByTypeId($typeId = null, $comparison = null)
    {
        if (is_array($typeId)) {
            $useMinMax = false;
            if (isset($typeId['min'])) {
                $this->addUsingAlias(PastoralCareTableMap::COL_PST_CR_TYPE_ID, $typeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($typeId['max'])) {
                $this->addUsingAlias(PastoralCareTableMap::COL_PST_CR_TYPE_ID, $typeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PastoralCareTableMap::COL_PST_CR_TYPE_ID, $typeId, $comparison);
    }

    /**
     * Filter the query on the pst_cr_visible column
     *
     * Example usage:
     * <code>
     * $query->filterByVisible(true); // WHERE pst_cr_visible = true
     * $query->filterByVisible('yes'); // WHERE pst_cr_visible = true
     * </code>
     *
     * @param     boolean|string $visible The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPastoralCareQuery The current query, for fluid interface
     */
    public function filterByVisible($visible = null, $comparison = null)
    {
        if (is_string($visible)) {
            $visible = in_array(strtolower($visible), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PastoralCareTableMap::COL_PST_CR_VISIBLE, $visible, $comparison);
    }

    /**
     * Filter the query on the pst_cr_Text column
     *
     * Example usage:
     * <code>
     * $query->filterByText('fooValue');   // WHERE pst_cr_Text = 'fooValue'
     * $query->filterByText('%fooValue%', Criteria::LIKE); // WHERE pst_cr_Text LIKE '%fooValue%'
     * </code>
     *
     * @param     string $text The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPastoralCareQuery The current query, for fluid interface
     */
    public function filterByText($text = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($text)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PastoralCareTableMap::COL_PST_CR_TEXT, $text, $comparison);
    }

    /**
     * Filter the query on the pst_cr_date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE pst_cr_date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE pst_cr_date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE pst_cr_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $date The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPastoralCareQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(PastoralCareTableMap::COL_PST_CR_DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(PastoralCareTableMap::COL_PST_CR_DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PastoralCareTableMap::COL_PST_CR_DATE, $date, $comparison);
    }

    /**
     * Filter the query by a related \EcclesiaCRM\PastoralCareType object
     *
     * @param \EcclesiaCRM\PastoralCareType|ObjectCollection $pastoralCareType The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPastoralCareQuery The current query, for fluid interface
     */
    public function filterByPastoralCareType($pastoralCareType, $comparison = null)
    {
        if ($pastoralCareType instanceof \EcclesiaCRM\PastoralCareType) {
            return $this
                ->addUsingAlias(PastoralCareTableMap::COL_PST_CR_TYPE_ID, $pastoralCareType->getId(), $comparison);
        } elseif ($pastoralCareType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PastoralCareTableMap::COL_PST_CR_TYPE_ID, $pastoralCareType->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPastoralCareType() only accepts arguments of type \EcclesiaCRM\PastoralCareType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PastoralCareType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPastoralCareQuery The current query, for fluid interface
     */
    public function joinPastoralCareType($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PastoralCareType');

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
            $this->addJoinObject($join, 'PastoralCareType');
        }

        return $this;
    }

    /**
     * Use the PastoralCareType relation PastoralCareType object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EcclesiaCRM\PastoralCareTypeQuery A secondary query class using the current class as primary query
     */
    public function usePastoralCareTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPastoralCareType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PastoralCareType', '\EcclesiaCRM\PastoralCareTypeQuery');
    }

    /**
     * Filter the query by a related \EcclesiaCRM\Person object
     *
     * @param \EcclesiaCRM\Person|ObjectCollection $person The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPastoralCareQuery The current query, for fluid interface
     */
    public function filterByPersonRelatedByPastorId($person, $comparison = null)
    {
        if ($person instanceof \EcclesiaCRM\Person) {
            return $this
                ->addUsingAlias(PastoralCareTableMap::COL_PST_CR_PASTOR_ID, $person->getId(), $comparison);
        } elseif ($person instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PastoralCareTableMap::COL_PST_CR_PASTOR_ID, $person->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPersonRelatedByPastorId() only accepts arguments of type \EcclesiaCRM\Person or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PersonRelatedByPastorId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPastoralCareQuery The current query, for fluid interface
     */
    public function joinPersonRelatedByPastorId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PersonRelatedByPastorId');

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
            $this->addJoinObject($join, 'PersonRelatedByPastorId');
        }

        return $this;
    }

    /**
     * Use the PersonRelatedByPastorId relation Person object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EcclesiaCRM\PersonQuery A secondary query class using the current class as primary query
     */
    public function usePersonRelatedByPastorIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPersonRelatedByPastorId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PersonRelatedByPastorId', '\EcclesiaCRM\PersonQuery');
    }

    /**
     * Filter the query by a related \EcclesiaCRM\Person object
     *
     * @param \EcclesiaCRM\Person|ObjectCollection $person The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPastoralCareQuery The current query, for fluid interface
     */
    public function filterByPersonRelatedByPersonId($person, $comparison = null)
    {
        if ($person instanceof \EcclesiaCRM\Person) {
            return $this
                ->addUsingAlias(PastoralCareTableMap::COL_PST_CR_PERSON_ID, $person->getId(), $comparison);
        } elseif ($person instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PastoralCareTableMap::COL_PST_CR_PERSON_ID, $person->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPersonRelatedByPersonId() only accepts arguments of type \EcclesiaCRM\Person or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PersonRelatedByPersonId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPastoralCareQuery The current query, for fluid interface
     */
    public function joinPersonRelatedByPersonId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PersonRelatedByPersonId');

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
            $this->addJoinObject($join, 'PersonRelatedByPersonId');
        }

        return $this;
    }

    /**
     * Use the PersonRelatedByPersonId relation Person object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EcclesiaCRM\PersonQuery A secondary query class using the current class as primary query
     */
    public function usePersonRelatedByPersonIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPersonRelatedByPersonId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PersonRelatedByPersonId', '\EcclesiaCRM\PersonQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPastoralCare $pastoralCare Object to remove from the list of results
     *
     * @return $this|ChildPastoralCareQuery The current query, for fluid interface
     */
    public function prune($pastoralCare = null)
    {
        if ($pastoralCare) {
            $this->addUsingAlias(PastoralCareTableMap::COL_PST_CR_ID, $pastoralCare->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the pastoral_care table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PastoralCareTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PastoralCareTableMap::clearInstancePool();
            PastoralCareTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PastoralCareTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PastoralCareTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PastoralCareTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PastoralCareTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PastoralCareQuery
