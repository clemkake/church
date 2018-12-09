<?php

namespace EcclesiaCRM\Base;

use \Exception;
use \PDO;
use EcclesiaCRM\CKEditorTemplates as ChildCKEditorTemplates;
use EcclesiaCRM\CKEditorTemplatesQuery as ChildCKEditorTemplatesQuery;
use EcclesiaCRM\Map\CKEditorTemplatesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'ckeditor_templates' table.
 *
 *
 *
 * @method     ChildCKEditorTemplatesQuery orderById($order = Criteria::ASC) Order by the cke_tmp_id column
 * @method     ChildCKEditorTemplatesQuery orderByPersonId($order = Criteria::ASC) Order by the cke_tmp_per_ID column
 * @method     ChildCKEditorTemplatesQuery orderByTitle($order = Criteria::ASC) Order by the cke_tmp_title column
 * @method     ChildCKEditorTemplatesQuery orderByDesc($order = Criteria::ASC) Order by the cke_tmp_desc column
 * @method     ChildCKEditorTemplatesQuery orderByText($order = Criteria::ASC) Order by the cke_tmp_text column
 * @method     ChildCKEditorTemplatesQuery orderByImage($order = Criteria::ASC) Order by the cke_tmp_image column
 *
 * @method     ChildCKEditorTemplatesQuery groupById() Group by the cke_tmp_id column
 * @method     ChildCKEditorTemplatesQuery groupByPersonId() Group by the cke_tmp_per_ID column
 * @method     ChildCKEditorTemplatesQuery groupByTitle() Group by the cke_tmp_title column
 * @method     ChildCKEditorTemplatesQuery groupByDesc() Group by the cke_tmp_desc column
 * @method     ChildCKEditorTemplatesQuery groupByText() Group by the cke_tmp_text column
 * @method     ChildCKEditorTemplatesQuery groupByImage() Group by the cke_tmp_image column
 *
 * @method     ChildCKEditorTemplatesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCKEditorTemplatesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCKEditorTemplatesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCKEditorTemplatesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCKEditorTemplatesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCKEditorTemplatesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCKEditorTemplatesQuery leftJoinPerson($relationAlias = null) Adds a LEFT JOIN clause to the query using the Person relation
 * @method     ChildCKEditorTemplatesQuery rightJoinPerson($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Person relation
 * @method     ChildCKEditorTemplatesQuery innerJoinPerson($relationAlias = null) Adds a INNER JOIN clause to the query using the Person relation
 *
 * @method     ChildCKEditorTemplatesQuery joinWithPerson($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Person relation
 *
 * @method     ChildCKEditorTemplatesQuery leftJoinWithPerson() Adds a LEFT JOIN clause and with to the query using the Person relation
 * @method     ChildCKEditorTemplatesQuery rightJoinWithPerson() Adds a RIGHT JOIN clause and with to the query using the Person relation
 * @method     ChildCKEditorTemplatesQuery innerJoinWithPerson() Adds a INNER JOIN clause and with to the query using the Person relation
 *
 * @method     \EcclesiaCRM\PersonQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCKEditorTemplates findOne(ConnectionInterface $con = null) Return the first ChildCKEditorTemplates matching the query
 * @method     ChildCKEditorTemplates findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCKEditorTemplates matching the query, or a new ChildCKEditorTemplates object populated from the query conditions when no match is found
 *
 * @method     ChildCKEditorTemplates findOneById(int $cke_tmp_id) Return the first ChildCKEditorTemplates filtered by the cke_tmp_id column
 * @method     ChildCKEditorTemplates findOneByPersonId(int $cke_tmp_per_ID) Return the first ChildCKEditorTemplates filtered by the cke_tmp_per_ID column
 * @method     ChildCKEditorTemplates findOneByTitle(string $cke_tmp_title) Return the first ChildCKEditorTemplates filtered by the cke_tmp_title column
 * @method     ChildCKEditorTemplates findOneByDesc(string $cke_tmp_desc) Return the first ChildCKEditorTemplates filtered by the cke_tmp_desc column
 * @method     ChildCKEditorTemplates findOneByText(string $cke_tmp_text) Return the first ChildCKEditorTemplates filtered by the cke_tmp_text column
 * @method     ChildCKEditorTemplates findOneByImage(string $cke_tmp_image) Return the first ChildCKEditorTemplates filtered by the cke_tmp_image column *

 * @method     ChildCKEditorTemplates requirePk($key, ConnectionInterface $con = null) Return the ChildCKEditorTemplates by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCKEditorTemplates requireOne(ConnectionInterface $con = null) Return the first ChildCKEditorTemplates matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCKEditorTemplates requireOneById(int $cke_tmp_id) Return the first ChildCKEditorTemplates filtered by the cke_tmp_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCKEditorTemplates requireOneByPersonId(int $cke_tmp_per_ID) Return the first ChildCKEditorTemplates filtered by the cke_tmp_per_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCKEditorTemplates requireOneByTitle(string $cke_tmp_title) Return the first ChildCKEditorTemplates filtered by the cke_tmp_title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCKEditorTemplates requireOneByDesc(string $cke_tmp_desc) Return the first ChildCKEditorTemplates filtered by the cke_tmp_desc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCKEditorTemplates requireOneByText(string $cke_tmp_text) Return the first ChildCKEditorTemplates filtered by the cke_tmp_text column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCKEditorTemplates requireOneByImage(string $cke_tmp_image) Return the first ChildCKEditorTemplates filtered by the cke_tmp_image column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCKEditorTemplates[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCKEditorTemplates objects based on current ModelCriteria
 * @method     ChildCKEditorTemplates[]|ObjectCollection findById(int $cke_tmp_id) Return ChildCKEditorTemplates objects filtered by the cke_tmp_id column
 * @method     ChildCKEditorTemplates[]|ObjectCollection findByPersonId(int $cke_tmp_per_ID) Return ChildCKEditorTemplates objects filtered by the cke_tmp_per_ID column
 * @method     ChildCKEditorTemplates[]|ObjectCollection findByTitle(string $cke_tmp_title) Return ChildCKEditorTemplates objects filtered by the cke_tmp_title column
 * @method     ChildCKEditorTemplates[]|ObjectCollection findByDesc(string $cke_tmp_desc) Return ChildCKEditorTemplates objects filtered by the cke_tmp_desc column
 * @method     ChildCKEditorTemplates[]|ObjectCollection findByText(string $cke_tmp_text) Return ChildCKEditorTemplates objects filtered by the cke_tmp_text column
 * @method     ChildCKEditorTemplates[]|ObjectCollection findByImage(string $cke_tmp_image) Return ChildCKEditorTemplates objects filtered by the cke_tmp_image column
 * @method     ChildCKEditorTemplates[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CKEditorTemplatesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \EcclesiaCRM\Base\CKEditorTemplatesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\EcclesiaCRM\\CKEditorTemplates', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCKEditorTemplatesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCKEditorTemplatesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCKEditorTemplatesQuery) {
            return $criteria;
        }
        $query = new ChildCKEditorTemplatesQuery();
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
     * @return ChildCKEditorTemplates|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CKEditorTemplatesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CKEditorTemplatesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCKEditorTemplates A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT cke_tmp_id, cke_tmp_per_ID, cke_tmp_title, cke_tmp_desc, cke_tmp_text, cke_tmp_image FROM ckeditor_templates WHERE cke_tmp_id = :p0';
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
            /** @var ChildCKEditorTemplates $obj */
            $obj = new ChildCKEditorTemplates();
            $obj->hydrate($row);
            CKEditorTemplatesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCKEditorTemplates|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCKEditorTemplatesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CKEditorTemplatesTableMap::COL_CKE_TMP_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCKEditorTemplatesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CKEditorTemplatesTableMap::COL_CKE_TMP_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the cke_tmp_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE cke_tmp_id = 1234
     * $query->filterById(array(12, 34)); // WHERE cke_tmp_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE cke_tmp_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCKEditorTemplatesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CKEditorTemplatesTableMap::COL_CKE_TMP_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CKEditorTemplatesTableMap::COL_CKE_TMP_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CKEditorTemplatesTableMap::COL_CKE_TMP_ID, $id, $comparison);
    }

    /**
     * Filter the query on the cke_tmp_per_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByPersonId(1234); // WHERE cke_tmp_per_ID = 1234
     * $query->filterByPersonId(array(12, 34)); // WHERE cke_tmp_per_ID IN (12, 34)
     * $query->filterByPersonId(array('min' => 12)); // WHERE cke_tmp_per_ID > 12
     * </code>
     *
     * @see       filterByPerson()
     *
     * @param     mixed $personId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCKEditorTemplatesQuery The current query, for fluid interface
     */
    public function filterByPersonId($personId = null, $comparison = null)
    {
        if (is_array($personId)) {
            $useMinMax = false;
            if (isset($personId['min'])) {
                $this->addUsingAlias(CKEditorTemplatesTableMap::COL_CKE_TMP_PER_ID, $personId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($personId['max'])) {
                $this->addUsingAlias(CKEditorTemplatesTableMap::COL_CKE_TMP_PER_ID, $personId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CKEditorTemplatesTableMap::COL_CKE_TMP_PER_ID, $personId, $comparison);
    }

    /**
     * Filter the query on the cke_tmp_title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE cke_tmp_title = 'fooValue'
     * $query->filterByTitle('%fooValue%', Criteria::LIKE); // WHERE cke_tmp_title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCKEditorTemplatesQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CKEditorTemplatesTableMap::COL_CKE_TMP_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the cke_tmp_desc column
     *
     * Example usage:
     * <code>
     * $query->filterByDesc('fooValue');   // WHERE cke_tmp_desc = 'fooValue'
     * $query->filterByDesc('%fooValue%', Criteria::LIKE); // WHERE cke_tmp_desc LIKE '%fooValue%'
     * </code>
     *
     * @param     string $desc The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCKEditorTemplatesQuery The current query, for fluid interface
     */
    public function filterByDesc($desc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($desc)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CKEditorTemplatesTableMap::COL_CKE_TMP_DESC, $desc, $comparison);
    }

    /**
     * Filter the query on the cke_tmp_text column
     *
     * Example usage:
     * <code>
     * $query->filterByText('fooValue');   // WHERE cke_tmp_text = 'fooValue'
     * $query->filterByText('%fooValue%', Criteria::LIKE); // WHERE cke_tmp_text LIKE '%fooValue%'
     * </code>
     *
     * @param     string $text The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCKEditorTemplatesQuery The current query, for fluid interface
     */
    public function filterByText($text = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($text)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CKEditorTemplatesTableMap::COL_CKE_TMP_TEXT, $text, $comparison);
    }

    /**
     * Filter the query on the cke_tmp_image column
     *
     * Example usage:
     * <code>
     * $query->filterByImage('fooValue');   // WHERE cke_tmp_image = 'fooValue'
     * $query->filterByImage('%fooValue%', Criteria::LIKE); // WHERE cke_tmp_image LIKE '%fooValue%'
     * </code>
     *
     * @param     string $image The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCKEditorTemplatesQuery The current query, for fluid interface
     */
    public function filterByImage($image = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($image)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CKEditorTemplatesTableMap::COL_CKE_TMP_IMAGE, $image, $comparison);
    }

    /**
     * Filter the query by a related \EcclesiaCRM\Person object
     *
     * @param \EcclesiaCRM\Person|ObjectCollection $person The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCKEditorTemplatesQuery The current query, for fluid interface
     */
    public function filterByPerson($person, $comparison = null)
    {
        if ($person instanceof \EcclesiaCRM\Person) {
            return $this
                ->addUsingAlias(CKEditorTemplatesTableMap::COL_CKE_TMP_PER_ID, $person->getId(), $comparison);
        } elseif ($person instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CKEditorTemplatesTableMap::COL_CKE_TMP_PER_ID, $person->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPerson() only accepts arguments of type \EcclesiaCRM\Person or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Person relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCKEditorTemplatesQuery The current query, for fluid interface
     */
    public function joinPerson($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Person');

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
            $this->addJoinObject($join, 'Person');
        }

        return $this;
    }

    /**
     * Use the Person relation Person object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EcclesiaCRM\PersonQuery A secondary query class using the current class as primary query
     */
    public function usePersonQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPerson($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Person', '\EcclesiaCRM\PersonQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCKEditorTemplates $cKEditorTemplates Object to remove from the list of results
     *
     * @return $this|ChildCKEditorTemplatesQuery The current query, for fluid interface
     */
    public function prune($cKEditorTemplates = null)
    {
        if ($cKEditorTemplates) {
            $this->addUsingAlias(CKEditorTemplatesTableMap::COL_CKE_TMP_ID, $cKEditorTemplates->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ckeditor_templates table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CKEditorTemplatesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CKEditorTemplatesTableMap::clearInstancePool();
            CKEditorTemplatesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CKEditorTemplatesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CKEditorTemplatesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CKEditorTemplatesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CKEditorTemplatesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CKEditorTemplatesQuery
