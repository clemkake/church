<?php

namespace EcclesiaCRM\Base;

use \Exception;
use \PDO;
use EcclesiaCRM\AutoPayment as ChildAutoPayment;
use EcclesiaCRM\AutoPaymentQuery as ChildAutoPaymentQuery;
use EcclesiaCRM\Deposit as ChildDeposit;
use EcclesiaCRM\DepositQuery as ChildDepositQuery;
use EcclesiaCRM\DonationFund as ChildDonationFund;
use EcclesiaCRM\DonationFundQuery as ChildDonationFundQuery;
use EcclesiaCRM\Pledge as ChildPledge;
use EcclesiaCRM\PledgeQuery as ChildPledgeQuery;
use EcclesiaCRM\Map\AutoPaymentTableMap;
use EcclesiaCRM\Map\DepositTableMap;
use EcclesiaCRM\Map\DonationFundTableMap;
use EcclesiaCRM\Map\PledgeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'donationfund_fun' table.
 *
 * This contains the defined donation funds
 *
 * @package    propel.generator.EcclesiaCRM.Base
 */
abstract class DonationFund implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\EcclesiaCRM\\Map\\DonationFundTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the fun_id field.
     *
     * @var        int
     */
    protected $fun_id;

    /**
     * The value for the fun_active field.
     *
     * Note: this column has a database default value of: 'true'
     * @var        string
     */
    protected $fun_active;

    /**
     * The value for the fun_name field.
     *
     * @var        string
     */
    protected $fun_name;

    /**
     * The value for the fun_description field.
     *
     * @var        string
     */
    protected $fun_description;

    /**
     * @var        ObjectCollection|ChildAutoPayment[] Collection to store aggregation of ChildAutoPayment objects.
     */
    protected $collAutoPayments;
    protected $collAutoPaymentsPartial;

    /**
     * @var        ObjectCollection|ChildDeposit[] Collection to store aggregation of ChildDeposit objects.
     */
    protected $collDeposits;
    protected $collDepositsPartial;

    /**
     * @var        ObjectCollection|ChildPledge[] Collection to store aggregation of ChildPledge objects.
     */
    protected $collPledges;
    protected $collPledgesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildAutoPayment[]
     */
    protected $autoPaymentsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDeposit[]
     */
    protected $depositsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPledge[]
     */
    protected $pledgesScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->fun_active = 'true';
    }

    /**
     * Initializes internal state of EcclesiaCRM\Base\DonationFund object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>DonationFund</code> instance.  If
     * <code>obj</code> is an instance of <code>DonationFund</code>, delegates to
     * <code>equals(DonationFund)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|DonationFund The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [fun_id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->fun_id;
    }

    /**
     * Get the [fun_active] column value.
     *
     * @return string
     */
    public function getActive()
    {
        return $this->fun_active;
    }

    /**
     * Get the [fun_name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->fun_name;
    }

    /**
     * Get the [fun_description] column value.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->fun_description;
    }

    /**
     * Set the value of [fun_id] column.
     *
     * @param int $v new value
     * @return $this|\EcclesiaCRM\DonationFund The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->fun_id !== $v) {
            $this->fun_id = $v;
            $this->modifiedColumns[DonationFundTableMap::COL_FUN_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [fun_active] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\DonationFund The current object (for fluent API support)
     */
    public function setActive($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fun_active !== $v) {
            $this->fun_active = $v;
            $this->modifiedColumns[DonationFundTableMap::COL_FUN_ACTIVE] = true;
        }

        return $this;
    } // setActive()

    /**
     * Set the value of [fun_name] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\DonationFund The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fun_name !== $v) {
            $this->fun_name = $v;
            $this->modifiedColumns[DonationFundTableMap::COL_FUN_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [fun_description] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\DonationFund The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fun_description !== $v) {
            $this->fun_description = $v;
            $this->modifiedColumns[DonationFundTableMap::COL_FUN_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->fun_active !== 'true') {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : DonationFundTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fun_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : DonationFundTableMap::translateFieldName('Active', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fun_active = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : DonationFundTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fun_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : DonationFundTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fun_description = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 4; // 4 = DonationFundTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\EcclesiaCRM\\DonationFund'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DonationFundTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildDonationFundQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collAutoPayments = null;

            $this->collDeposits = null;

            $this->collPledges = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see DonationFund::setDeleted()
     * @see DonationFund::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(DonationFundTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildDonationFundQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(DonationFundTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                DonationFundTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->autoPaymentsScheduledForDeletion !== null) {
                if (!$this->autoPaymentsScheduledForDeletion->isEmpty()) {
                    \EcclesiaCRM\AutoPaymentQuery::create()
                        ->filterByPrimaryKeys($this->autoPaymentsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->autoPaymentsScheduledForDeletion = null;
                }
            }

            if ($this->collAutoPayments !== null) {
                foreach ($this->collAutoPayments as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->depositsScheduledForDeletion !== null) {
                if (!$this->depositsScheduledForDeletion->isEmpty()) {
                    \EcclesiaCRM\DepositQuery::create()
                        ->filterByPrimaryKeys($this->depositsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->depositsScheduledForDeletion = null;
                }
            }

            if ($this->collDeposits !== null) {
                foreach ($this->collDeposits as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->pledgesScheduledForDeletion !== null) {
                if (!$this->pledgesScheduledForDeletion->isEmpty()) {
                    foreach ($this->pledgesScheduledForDeletion as $pledge) {
                        // need to save related object because we set the relation to null
                        $pledge->save($con);
                    }
                    $this->pledgesScheduledForDeletion = null;
                }
            }

            if ($this->collPledges !== null) {
                foreach ($this->collPledges as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[DonationFundTableMap::COL_FUN_ID] = true;
        if (null !== $this->fun_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . DonationFundTableMap::COL_FUN_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(DonationFundTableMap::COL_FUN_ID)) {
            $modifiedColumns[':p' . $index++]  = 'fun_ID';
        }
        if ($this->isColumnModified(DonationFundTableMap::COL_FUN_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'fun_Active';
        }
        if ($this->isColumnModified(DonationFundTableMap::COL_FUN_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'fun_Name';
        }
        if ($this->isColumnModified(DonationFundTableMap::COL_FUN_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'fun_Description';
        }

        $sql = sprintf(
            'INSERT INTO donationfund_fun (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'fun_ID':
                        $stmt->bindValue($identifier, $this->fun_id, PDO::PARAM_INT);
                        break;
                    case 'fun_Active':
                        $stmt->bindValue($identifier, $this->fun_active, PDO::PARAM_STR);
                        break;
                    case 'fun_Name':
                        $stmt->bindValue($identifier, $this->fun_name, PDO::PARAM_STR);
                        break;
                    case 'fun_Description':
                        $stmt->bindValue($identifier, $this->fun_description, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = DonationFundTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getActive();
                break;
            case 2:
                return $this->getName();
                break;
            case 3:
                return $this->getDescription();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['DonationFund'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['DonationFund'][$this->hashCode()] = true;
        $keys = DonationFundTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getActive(),
            $keys[2] => $this->getName(),
            $keys[3] => $this->getDescription(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collAutoPayments) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'autoPayments';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'autopayment_auts';
                        break;
                    default:
                        $key = 'AutoPayments';
                }

                $result[$key] = $this->collAutoPayments->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collDeposits) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'deposits';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'deposit_deps';
                        break;
                    default:
                        $key = 'Deposits';
                }

                $result[$key] = $this->collDeposits->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPledges) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'pledges';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'pledge_plgs';
                        break;
                    default:
                        $key = 'Pledges';
                }

                $result[$key] = $this->collPledges->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\EcclesiaCRM\DonationFund
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = DonationFundTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\EcclesiaCRM\DonationFund
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setActive($value);
                break;
            case 2:
                $this->setName($value);
                break;
            case 3:
                $this->setDescription($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = DonationFundTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setActive($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setDescription($arr[$keys[3]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\EcclesiaCRM\DonationFund The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(DonationFundTableMap::DATABASE_NAME);

        if ($this->isColumnModified(DonationFundTableMap::COL_FUN_ID)) {
            $criteria->add(DonationFundTableMap::COL_FUN_ID, $this->fun_id);
        }
        if ($this->isColumnModified(DonationFundTableMap::COL_FUN_ACTIVE)) {
            $criteria->add(DonationFundTableMap::COL_FUN_ACTIVE, $this->fun_active);
        }
        if ($this->isColumnModified(DonationFundTableMap::COL_FUN_NAME)) {
            $criteria->add(DonationFundTableMap::COL_FUN_NAME, $this->fun_name);
        }
        if ($this->isColumnModified(DonationFundTableMap::COL_FUN_DESCRIPTION)) {
            $criteria->add(DonationFundTableMap::COL_FUN_DESCRIPTION, $this->fun_description);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildDonationFundQuery::create();
        $criteria->add(DonationFundTableMap::COL_FUN_ID, $this->fun_id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (fun_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \EcclesiaCRM\DonationFund (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setActive($this->getActive());
        $copyObj->setName($this->getName());
        $copyObj->setDescription($this->getDescription());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getAutoPayments() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAutoPayment($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDeposits() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDeposit($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPledges() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPledge($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \EcclesiaCRM\DonationFund Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('AutoPayment' == $relationName) {
            $this->initAutoPayments();
            return;
        }
        if ('Deposit' == $relationName) {
            $this->initDeposits();
            return;
        }
        if ('Pledge' == $relationName) {
            $this->initPledges();
            return;
        }
    }

    /**
     * Clears out the collAutoPayments collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addAutoPayments()
     */
    public function clearAutoPayments()
    {
        $this->collAutoPayments = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collAutoPayments collection loaded partially.
     */
    public function resetPartialAutoPayments($v = true)
    {
        $this->collAutoPaymentsPartial = $v;
    }

    /**
     * Initializes the collAutoPayments collection.
     *
     * By default this just sets the collAutoPayments collection to an empty array (like clearcollAutoPayments());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAutoPayments($overrideExisting = true)
    {
        if (null !== $this->collAutoPayments && !$overrideExisting) {
            return;
        }

        $collectionClassName = AutoPaymentTableMap::getTableMap()->getCollectionClassName();

        $this->collAutoPayments = new $collectionClassName;
        $this->collAutoPayments->setModel('\EcclesiaCRM\AutoPayment');
    }

    /**
     * Gets an array of ChildAutoPayment objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildDonationFund is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAutoPayment[] List of ChildAutoPayment objects
     * @throws PropelException
     */
    public function getAutoPayments(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collAutoPaymentsPartial && !$this->isNew();
        if (null === $this->collAutoPayments || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAutoPayments) {
                // return empty collection
                $this->initAutoPayments();
            } else {
                $collAutoPayments = ChildAutoPaymentQuery::create(null, $criteria)
                    ->filterByDonationFund($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAutoPaymentsPartial && count($collAutoPayments)) {
                        $this->initAutoPayments(false);

                        foreach ($collAutoPayments as $obj) {
                            if (false == $this->collAutoPayments->contains($obj)) {
                                $this->collAutoPayments->append($obj);
                            }
                        }

                        $this->collAutoPaymentsPartial = true;
                    }

                    return $collAutoPayments;
                }

                if ($partial && $this->collAutoPayments) {
                    foreach ($this->collAutoPayments as $obj) {
                        if ($obj->isNew()) {
                            $collAutoPayments[] = $obj;
                        }
                    }
                }

                $this->collAutoPayments = $collAutoPayments;
                $this->collAutoPaymentsPartial = false;
            }
        }

        return $this->collAutoPayments;
    }

    /**
     * Sets a collection of ChildAutoPayment objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $autoPayments A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildDonationFund The current object (for fluent API support)
     */
    public function setAutoPayments(Collection $autoPayments, ConnectionInterface $con = null)
    {
        /** @var ChildAutoPayment[] $autoPaymentsToDelete */
        $autoPaymentsToDelete = $this->getAutoPayments(new Criteria(), $con)->diff($autoPayments);


        $this->autoPaymentsScheduledForDeletion = $autoPaymentsToDelete;

        foreach ($autoPaymentsToDelete as $autoPaymentRemoved) {
            $autoPaymentRemoved->setDonationFund(null);
        }

        $this->collAutoPayments = null;
        foreach ($autoPayments as $autoPayment) {
            $this->addAutoPayment($autoPayment);
        }

        $this->collAutoPayments = $autoPayments;
        $this->collAutoPaymentsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related AutoPayment objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related AutoPayment objects.
     * @throws PropelException
     */
    public function countAutoPayments(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collAutoPaymentsPartial && !$this->isNew();
        if (null === $this->collAutoPayments || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAutoPayments) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAutoPayments());
            }

            $query = ChildAutoPaymentQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDonationFund($this)
                ->count($con);
        }

        return count($this->collAutoPayments);
    }

    /**
     * Method called to associate a ChildAutoPayment object to this object
     * through the ChildAutoPayment foreign key attribute.
     *
     * @param  ChildAutoPayment $l ChildAutoPayment
     * @return $this|\EcclesiaCRM\DonationFund The current object (for fluent API support)
     */
    public function addAutoPayment(ChildAutoPayment $l)
    {
        if ($this->collAutoPayments === null) {
            $this->initAutoPayments();
            $this->collAutoPaymentsPartial = true;
        }

        if (!$this->collAutoPayments->contains($l)) {
            $this->doAddAutoPayment($l);

            if ($this->autoPaymentsScheduledForDeletion and $this->autoPaymentsScheduledForDeletion->contains($l)) {
                $this->autoPaymentsScheduledForDeletion->remove($this->autoPaymentsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildAutoPayment $autoPayment The ChildAutoPayment object to add.
     */
    protected function doAddAutoPayment(ChildAutoPayment $autoPayment)
    {
        $this->collAutoPayments[]= $autoPayment;
        $autoPayment->setDonationFund($this);
    }

    /**
     * @param  ChildAutoPayment $autoPayment The ChildAutoPayment object to remove.
     * @return $this|ChildDonationFund The current object (for fluent API support)
     */
    public function removeAutoPayment(ChildAutoPayment $autoPayment)
    {
        if ($this->getAutoPayments()->contains($autoPayment)) {
            $pos = $this->collAutoPayments->search($autoPayment);
            $this->collAutoPayments->remove($pos);
            if (null === $this->autoPaymentsScheduledForDeletion) {
                $this->autoPaymentsScheduledForDeletion = clone $this->collAutoPayments;
                $this->autoPaymentsScheduledForDeletion->clear();
            }
            $this->autoPaymentsScheduledForDeletion[]= clone $autoPayment;
            $autoPayment->setDonationFund(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this DonationFund is new, it will return
     * an empty collection; or if this DonationFund has previously
     * been saved, it will retrieve related AutoPayments from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in DonationFund.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAutoPayment[] List of ChildAutoPayment objects
     */
    public function getAutoPaymentsJoinPerson(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAutoPaymentQuery::create(null, $criteria);
        $query->joinWith('Person', $joinBehavior);

        return $this->getAutoPayments($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this DonationFund is new, it will return
     * an empty collection; or if this DonationFund has previously
     * been saved, it will retrieve related AutoPayments from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in DonationFund.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAutoPayment[] List of ChildAutoPayment objects
     */
    public function getAutoPaymentsJoinFamily(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAutoPaymentQuery::create(null, $criteria);
        $query->joinWith('Family', $joinBehavior);

        return $this->getAutoPayments($query, $con);
    }

    /**
     * Clears out the collDeposits collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addDeposits()
     */
    public function clearDeposits()
    {
        $this->collDeposits = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collDeposits collection loaded partially.
     */
    public function resetPartialDeposits($v = true)
    {
        $this->collDepositsPartial = $v;
    }

    /**
     * Initializes the collDeposits collection.
     *
     * By default this just sets the collDeposits collection to an empty array (like clearcollDeposits());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDeposits($overrideExisting = true)
    {
        if (null !== $this->collDeposits && !$overrideExisting) {
            return;
        }

        $collectionClassName = DepositTableMap::getTableMap()->getCollectionClassName();

        $this->collDeposits = new $collectionClassName;
        $this->collDeposits->setModel('\EcclesiaCRM\Deposit');
    }

    /**
     * Gets an array of ChildDeposit objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildDonationFund is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDeposit[] List of ChildDeposit objects
     * @throws PropelException
     */
    public function getDeposits(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collDepositsPartial && !$this->isNew();
        if (null === $this->collDeposits || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collDeposits) {
                // return empty collection
                $this->initDeposits();
            } else {
                $collDeposits = ChildDepositQuery::create(null, $criteria)
                    ->filterByDonationFund($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDepositsPartial && count($collDeposits)) {
                        $this->initDeposits(false);

                        foreach ($collDeposits as $obj) {
                            if (false == $this->collDeposits->contains($obj)) {
                                $this->collDeposits->append($obj);
                            }
                        }

                        $this->collDepositsPartial = true;
                    }

                    return $collDeposits;
                }

                if ($partial && $this->collDeposits) {
                    foreach ($this->collDeposits as $obj) {
                        if ($obj->isNew()) {
                            $collDeposits[] = $obj;
                        }
                    }
                }

                $this->collDeposits = $collDeposits;
                $this->collDepositsPartial = false;
            }
        }

        return $this->collDeposits;
    }

    /**
     * Sets a collection of ChildDeposit objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $deposits A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildDonationFund The current object (for fluent API support)
     */
    public function setDeposits(Collection $deposits, ConnectionInterface $con = null)
    {
        /** @var ChildDeposit[] $depositsToDelete */
        $depositsToDelete = $this->getDeposits(new Criteria(), $con)->diff($deposits);


        $this->depositsScheduledForDeletion = $depositsToDelete;

        foreach ($depositsToDelete as $depositRemoved) {
            $depositRemoved->setDonationFund(null);
        }

        $this->collDeposits = null;
        foreach ($deposits as $deposit) {
            $this->addDeposit($deposit);
        }

        $this->collDeposits = $deposits;
        $this->collDepositsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Deposit objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Deposit objects.
     * @throws PropelException
     */
    public function countDeposits(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collDepositsPartial && !$this->isNew();
        if (null === $this->collDeposits || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDeposits) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDeposits());
            }

            $query = ChildDepositQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDonationFund($this)
                ->count($con);
        }

        return count($this->collDeposits);
    }

    /**
     * Method called to associate a ChildDeposit object to this object
     * through the ChildDeposit foreign key attribute.
     *
     * @param  ChildDeposit $l ChildDeposit
     * @return $this|\EcclesiaCRM\DonationFund The current object (for fluent API support)
     */
    public function addDeposit(ChildDeposit $l)
    {
        if ($this->collDeposits === null) {
            $this->initDeposits();
            $this->collDepositsPartial = true;
        }

        if (!$this->collDeposits->contains($l)) {
            $this->doAddDeposit($l);

            if ($this->depositsScheduledForDeletion and $this->depositsScheduledForDeletion->contains($l)) {
                $this->depositsScheduledForDeletion->remove($this->depositsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDeposit $deposit The ChildDeposit object to add.
     */
    protected function doAddDeposit(ChildDeposit $deposit)
    {
        $this->collDeposits[]= $deposit;
        $deposit->setDonationFund($this);
    }

    /**
     * @param  ChildDeposit $deposit The ChildDeposit object to remove.
     * @return $this|ChildDonationFund The current object (for fluent API support)
     */
    public function removeDeposit(ChildDeposit $deposit)
    {
        if ($this->getDeposits()->contains($deposit)) {
            $pos = $this->collDeposits->search($deposit);
            $this->collDeposits->remove($pos);
            if (null === $this->depositsScheduledForDeletion) {
                $this->depositsScheduledForDeletion = clone $this->collDeposits;
                $this->depositsScheduledForDeletion->clear();
            }
            $this->depositsScheduledForDeletion[]= clone $deposit;
            $deposit->setDonationFund(null);
        }

        return $this;
    }

    /**
     * Clears out the collPledges collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPledges()
     */
    public function clearPledges()
    {
        $this->collPledges = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPledges collection loaded partially.
     */
    public function resetPartialPledges($v = true)
    {
        $this->collPledgesPartial = $v;
    }

    /**
     * Initializes the collPledges collection.
     *
     * By default this just sets the collPledges collection to an empty array (like clearcollPledges());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPledges($overrideExisting = true)
    {
        if (null !== $this->collPledges && !$overrideExisting) {
            return;
        }

        $collectionClassName = PledgeTableMap::getTableMap()->getCollectionClassName();

        $this->collPledges = new $collectionClassName;
        $this->collPledges->setModel('\EcclesiaCRM\Pledge');
    }

    /**
     * Gets an array of ChildPledge objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildDonationFund is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPledge[] List of ChildPledge objects
     * @throws PropelException
     */
    public function getPledges(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPledgesPartial && !$this->isNew();
        if (null === $this->collPledges || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPledges) {
                // return empty collection
                $this->initPledges();
            } else {
                $collPledges = ChildPledgeQuery::create(null, $criteria)
                    ->filterByDonationFund($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPledgesPartial && count($collPledges)) {
                        $this->initPledges(false);

                        foreach ($collPledges as $obj) {
                            if (false == $this->collPledges->contains($obj)) {
                                $this->collPledges->append($obj);
                            }
                        }

                        $this->collPledgesPartial = true;
                    }

                    return $collPledges;
                }

                if ($partial && $this->collPledges) {
                    foreach ($this->collPledges as $obj) {
                        if ($obj->isNew()) {
                            $collPledges[] = $obj;
                        }
                    }
                }

                $this->collPledges = $collPledges;
                $this->collPledgesPartial = false;
            }
        }

        return $this->collPledges;
    }

    /**
     * Sets a collection of ChildPledge objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $pledges A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildDonationFund The current object (for fluent API support)
     */
    public function setPledges(Collection $pledges, ConnectionInterface $con = null)
    {
        /** @var ChildPledge[] $pledgesToDelete */
        $pledgesToDelete = $this->getPledges(new Criteria(), $con)->diff($pledges);


        $this->pledgesScheduledForDeletion = $pledgesToDelete;

        foreach ($pledgesToDelete as $pledgeRemoved) {
            $pledgeRemoved->setDonationFund(null);
        }

        $this->collPledges = null;
        foreach ($pledges as $pledge) {
            $this->addPledge($pledge);
        }

        $this->collPledges = $pledges;
        $this->collPledgesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Pledge objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Pledge objects.
     * @throws PropelException
     */
    public function countPledges(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPledgesPartial && !$this->isNew();
        if (null === $this->collPledges || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPledges) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPledges());
            }

            $query = ChildPledgeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDonationFund($this)
                ->count($con);
        }

        return count($this->collPledges);
    }

    /**
     * Method called to associate a ChildPledge object to this object
     * through the ChildPledge foreign key attribute.
     *
     * @param  ChildPledge $l ChildPledge
     * @return $this|\EcclesiaCRM\DonationFund The current object (for fluent API support)
     */
    public function addPledge(ChildPledge $l)
    {
        if ($this->collPledges === null) {
            $this->initPledges();
            $this->collPledgesPartial = true;
        }

        if (!$this->collPledges->contains($l)) {
            $this->doAddPledge($l);

            if ($this->pledgesScheduledForDeletion and $this->pledgesScheduledForDeletion->contains($l)) {
                $this->pledgesScheduledForDeletion->remove($this->pledgesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPledge $pledge The ChildPledge object to add.
     */
    protected function doAddPledge(ChildPledge $pledge)
    {
        $this->collPledges[]= $pledge;
        $pledge->setDonationFund($this);
    }

    /**
     * @param  ChildPledge $pledge The ChildPledge object to remove.
     * @return $this|ChildDonationFund The current object (for fluent API support)
     */
    public function removePledge(ChildPledge $pledge)
    {
        if ($this->getPledges()->contains($pledge)) {
            $pos = $this->collPledges->search($pledge);
            $this->collPledges->remove($pos);
            if (null === $this->pledgesScheduledForDeletion) {
                $this->pledgesScheduledForDeletion = clone $this->collPledges;
                $this->pledgesScheduledForDeletion->clear();
            }
            $this->pledgesScheduledForDeletion[]= $pledge;
            $pledge->setDonationFund(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this DonationFund is new, it will return
     * an empty collection; or if this DonationFund has previously
     * been saved, it will retrieve related Pledges from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in DonationFund.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPledge[] List of ChildPledge objects
     */
    public function getPledgesJoinDeposit(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPledgeQuery::create(null, $criteria);
        $query->joinWith('Deposit', $joinBehavior);

        return $this->getPledges($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this DonationFund is new, it will return
     * an empty collection; or if this DonationFund has previously
     * been saved, it will retrieve related Pledges from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in DonationFund.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPledge[] List of ChildPledge objects
     */
    public function getPledgesJoinFamily(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPledgeQuery::create(null, $criteria);
        $query->joinWith('Family', $joinBehavior);

        return $this->getPledges($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this DonationFund is new, it will return
     * an empty collection; or if this DonationFund has previously
     * been saved, it will retrieve related Pledges from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in DonationFund.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPledge[] List of ChildPledge objects
     */
    public function getPledgesJoinAutoPayment(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPledgeQuery::create(null, $criteria);
        $query->joinWith('AutoPayment', $joinBehavior);

        return $this->getPledges($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this DonationFund is new, it will return
     * an empty collection; or if this DonationFund has previously
     * been saved, it will retrieve related Pledges from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in DonationFund.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPledge[] List of ChildPledge objects
     */
    public function getPledgesJoinPerson(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPledgeQuery::create(null, $criteria);
        $query->joinWith('Person', $joinBehavior);

        return $this->getPledges($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->fun_id = null;
        $this->fun_active = null;
        $this->fun_name = null;
        $this->fun_description = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collAutoPayments) {
                foreach ($this->collAutoPayments as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDeposits) {
                foreach ($this->collDeposits as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPledges) {
                foreach ($this->collPledges as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collAutoPayments = null;
        $this->collDeposits = null;
        $this->collPledges = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(DonationFundTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
