<?php

namespace EcclesiaCRM\Base;

use \Exception;
use \PDO;
use EcclesiaCRM\Addressbookchanges as ChildAddressbookchanges;
use EcclesiaCRM\AddressbookchangesQuery as ChildAddressbookchangesQuery;
use EcclesiaCRM\Addressbooks as ChildAddressbooks;
use EcclesiaCRM\AddressbooksQuery as ChildAddressbooksQuery;
use EcclesiaCRM\Cards as ChildCards;
use EcclesiaCRM\CardsQuery as ChildCardsQuery;
use EcclesiaCRM\Map\AddressbookchangesTableMap;
use EcclesiaCRM\Map\AddressbooksTableMap;
use EcclesiaCRM\Map\CardsTableMap;
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
 * Base class that represents a row from the 'addressbooks' table.
 *
 *
 *
 * @package    propel.generator.EcclesiaCRM.Base
 */
abstract class Addressbooks implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\EcclesiaCRM\\Map\\AddressbooksTableMap';


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
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the principaluri field.
     *
     * @var        string
     */
    protected $principaluri;

    /**
     * The value for the displayname field.
     *
     * @var        string
     */
    protected $displayname;

    /**
     * The value for the uri field.
     *
     * @var        string
     */
    protected $uri;

    /**
     * The value for the description field.
     *
     * @var        string
     */
    protected $description;

    /**
     * The value for the synctoken field.
     *
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $synctoken;

    /**
     * @var        ObjectCollection|ChildAddressbookchanges[] Collection to store aggregation of ChildAddressbookchanges objects.
     */
    protected $collAddressbookchangess;
    protected $collAddressbookchangessPartial;

    /**
     * @var        ObjectCollection|ChildCards[] Collection to store aggregation of ChildCards objects.
     */
    protected $collCardss;
    protected $collCardssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildAddressbookchanges[]
     */
    protected $addressbookchangessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCards[]
     */
    protected $cardssScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->synctoken = 1;
    }

    /**
     * Initializes internal state of EcclesiaCRM\Base\Addressbooks object.
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
     * Compares this with another <code>Addressbooks</code> instance.  If
     * <code>obj</code> is an instance of <code>Addressbooks</code>, delegates to
     * <code>equals(Addressbooks)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Addressbooks The current object, for fluid interface
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
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [principaluri] column value.
     *
     * @return string
     */
    public function getPrincipalUri()
    {
        return $this->principaluri;
    }

    /**
     * Get the [displayname] column value.
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayname;
    }

    /**
     * Get the [uri] column value.
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Get the [description] column value.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the [synctoken] column value.
     *
     * @return int
     */
    public function getSynctoken()
    {
        return $this->synctoken;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\EcclesiaCRM\Addressbooks The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[AddressbooksTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [principaluri] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Addressbooks The current object (for fluent API support)
     */
    public function setPrincipalUri($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->principaluri !== $v) {
            $this->principaluri = $v;
            $this->modifiedColumns[AddressbooksTableMap::COL_PRINCIPALURI] = true;
        }

        return $this;
    } // setPrincipalUri()

    /**
     * Set the value of [displayname] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Addressbooks The current object (for fluent API support)
     */
    public function setDisplayName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->displayname !== $v) {
            $this->displayname = $v;
            $this->modifiedColumns[AddressbooksTableMap::COL_DISPLAYNAME] = true;
        }

        return $this;
    } // setDisplayName()

    /**
     * Set the value of [uri] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Addressbooks The current object (for fluent API support)
     */
    public function setUri($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->uri !== $v) {
            $this->uri = $v;
            $this->modifiedColumns[AddressbooksTableMap::COL_URI] = true;
        }

        return $this;
    } // setUri()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return $this|\EcclesiaCRM\Addressbooks The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[AddressbooksTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Set the value of [synctoken] column.
     *
     * @param int $v new value
     * @return $this|\EcclesiaCRM\Addressbooks The current object (for fluent API support)
     */
    public function setSynctoken($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->synctoken !== $v) {
            $this->synctoken = $v;
            $this->modifiedColumns[AddressbooksTableMap::COL_SYNCTOKEN] = true;
        }

        return $this;
    } // setSynctoken()

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
            if ($this->synctoken !== 1) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : AddressbooksTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : AddressbooksTableMap::translateFieldName('PrincipalUri', TableMap::TYPE_PHPNAME, $indexType)];
            $this->principaluri = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : AddressbooksTableMap::translateFieldName('DisplayName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->displayname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : AddressbooksTableMap::translateFieldName('Uri', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uri = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : AddressbooksTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : AddressbooksTableMap::translateFieldName('Synctoken', TableMap::TYPE_PHPNAME, $indexType)];
            $this->synctoken = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = AddressbooksTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\EcclesiaCRM\\Addressbooks'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(AddressbooksTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildAddressbooksQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collAddressbookchangess = null;

            $this->collCardss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Addressbooks::setDeleted()
     * @see Addressbooks::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(AddressbooksTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildAddressbooksQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(AddressbooksTableMap::DATABASE_NAME);
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
                AddressbooksTableMap::addInstanceToPool($this);
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

            if ($this->addressbookchangessScheduledForDeletion !== null) {
                if (!$this->addressbookchangessScheduledForDeletion->isEmpty()) {
                    \EcclesiaCRM\AddressbookchangesQuery::create()
                        ->filterByPrimaryKeys($this->addressbookchangessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->addressbookchangessScheduledForDeletion = null;
                }
            }

            if ($this->collAddressbookchangess !== null) {
                foreach ($this->collAddressbookchangess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->cardssScheduledForDeletion !== null) {
                if (!$this->cardssScheduledForDeletion->isEmpty()) {
                    \EcclesiaCRM\CardsQuery::create()
                        ->filterByPrimaryKeys($this->cardssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->cardssScheduledForDeletion = null;
                }
            }

            if ($this->collCardss !== null) {
                foreach ($this->collCardss as $referrerFK) {
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

        $this->modifiedColumns[AddressbooksTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . AddressbooksTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(AddressbooksTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(AddressbooksTableMap::COL_PRINCIPALURI)) {
            $modifiedColumns[':p' . $index++]  = 'principaluri';
        }
        if ($this->isColumnModified(AddressbooksTableMap::COL_DISPLAYNAME)) {
            $modifiedColumns[':p' . $index++]  = 'displayname';
        }
        if ($this->isColumnModified(AddressbooksTableMap::COL_URI)) {
            $modifiedColumns[':p' . $index++]  = 'uri';
        }
        if ($this->isColumnModified(AddressbooksTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'description';
        }
        if ($this->isColumnModified(AddressbooksTableMap::COL_SYNCTOKEN)) {
            $modifiedColumns[':p' . $index++]  = 'synctoken';
        }

        $sql = sprintf(
            'INSERT INTO addressbooks (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'principaluri':
                        $stmt->bindValue($identifier, $this->principaluri, PDO::PARAM_STR);
                        break;
                    case 'displayname':
                        $stmt->bindValue($identifier, $this->displayname, PDO::PARAM_STR);
                        break;
                    case 'uri':
                        $stmt->bindValue($identifier, $this->uri, PDO::PARAM_STR);
                        break;
                    case 'description':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case 'synctoken':
                        $stmt->bindValue($identifier, $this->synctoken, PDO::PARAM_INT);
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
        $pos = AddressbooksTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getPrincipalUri();
                break;
            case 2:
                return $this->getDisplayName();
                break;
            case 3:
                return $this->getUri();
                break;
            case 4:
                return $this->getDescription();
                break;
            case 5:
                return $this->getSynctoken();
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

        if (isset($alreadyDumpedObjects['Addressbooks'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Addressbooks'][$this->hashCode()] = true;
        $keys = AddressbooksTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getPrincipalUri(),
            $keys[2] => $this->getDisplayName(),
            $keys[3] => $this->getUri(),
            $keys[4] => $this->getDescription(),
            $keys[5] => $this->getSynctoken(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collAddressbookchangess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'addressbookchangess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'addressbookchangess';
                        break;
                    default:
                        $key = 'Addressbookchangess';
                }

                $result[$key] = $this->collAddressbookchangess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCardss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'cardss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'cardss';
                        break;
                    default:
                        $key = 'Cardss';
                }

                $result[$key] = $this->collCardss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\EcclesiaCRM\Addressbooks
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = AddressbooksTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\EcclesiaCRM\Addressbooks
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setPrincipalUri($value);
                break;
            case 2:
                $this->setDisplayName($value);
                break;
            case 3:
                $this->setUri($value);
                break;
            case 4:
                $this->setDescription($value);
                break;
            case 5:
                $this->setSynctoken($value);
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
        $keys = AddressbooksTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setPrincipalUri($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setDisplayName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setUri($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDescription($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setSynctoken($arr[$keys[5]]);
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
     * @return $this|\EcclesiaCRM\Addressbooks The current object, for fluid interface
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
        $criteria = new Criteria(AddressbooksTableMap::DATABASE_NAME);

        if ($this->isColumnModified(AddressbooksTableMap::COL_ID)) {
            $criteria->add(AddressbooksTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(AddressbooksTableMap::COL_PRINCIPALURI)) {
            $criteria->add(AddressbooksTableMap::COL_PRINCIPALURI, $this->principaluri);
        }
        if ($this->isColumnModified(AddressbooksTableMap::COL_DISPLAYNAME)) {
            $criteria->add(AddressbooksTableMap::COL_DISPLAYNAME, $this->displayname);
        }
        if ($this->isColumnModified(AddressbooksTableMap::COL_URI)) {
            $criteria->add(AddressbooksTableMap::COL_URI, $this->uri);
        }
        if ($this->isColumnModified(AddressbooksTableMap::COL_DESCRIPTION)) {
            $criteria->add(AddressbooksTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(AddressbooksTableMap::COL_SYNCTOKEN)) {
            $criteria->add(AddressbooksTableMap::COL_SYNCTOKEN, $this->synctoken);
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
        $criteria = ChildAddressbooksQuery::create();
        $criteria->add(AddressbooksTableMap::COL_ID, $this->id);

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
     * Generic method to set the primary key (id column).
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
     * @param      object $copyObj An object of \EcclesiaCRM\Addressbooks (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setPrincipalUri($this->getPrincipalUri());
        $copyObj->setDisplayName($this->getDisplayName());
        $copyObj->setUri($this->getUri());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setSynctoken($this->getSynctoken());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getAddressbookchangess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAddressbookchanges($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCardss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCards($relObj->copy($deepCopy));
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
     * @return \EcclesiaCRM\Addressbooks Clone of current object.
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
        if ('Addressbookchanges' == $relationName) {
            $this->initAddressbookchangess();
            return;
        }
        if ('Cards' == $relationName) {
            $this->initCardss();
            return;
        }
    }

    /**
     * Clears out the collAddressbookchangess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addAddressbookchangess()
     */
    public function clearAddressbookchangess()
    {
        $this->collAddressbookchangess = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collAddressbookchangess collection loaded partially.
     */
    public function resetPartialAddressbookchangess($v = true)
    {
        $this->collAddressbookchangessPartial = $v;
    }

    /**
     * Initializes the collAddressbookchangess collection.
     *
     * By default this just sets the collAddressbookchangess collection to an empty array (like clearcollAddressbookchangess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAddressbookchangess($overrideExisting = true)
    {
        if (null !== $this->collAddressbookchangess && !$overrideExisting) {
            return;
        }

        $collectionClassName = AddressbookchangesTableMap::getTableMap()->getCollectionClassName();

        $this->collAddressbookchangess = new $collectionClassName;
        $this->collAddressbookchangess->setModel('\EcclesiaCRM\Addressbookchanges');
    }

    /**
     * Gets an array of ChildAddressbookchanges objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildAddressbooks is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAddressbookchanges[] List of ChildAddressbookchanges objects
     * @throws PropelException
     */
    public function getAddressbookchangess(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collAddressbookchangessPartial && !$this->isNew();
        if (null === $this->collAddressbookchangess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAddressbookchangess) {
                // return empty collection
                $this->initAddressbookchangess();
            } else {
                $collAddressbookchangess = ChildAddressbookchangesQuery::create(null, $criteria)
                    ->filterByAddressbooks($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAddressbookchangessPartial && count($collAddressbookchangess)) {
                        $this->initAddressbookchangess(false);

                        foreach ($collAddressbookchangess as $obj) {
                            if (false == $this->collAddressbookchangess->contains($obj)) {
                                $this->collAddressbookchangess->append($obj);
                            }
                        }

                        $this->collAddressbookchangessPartial = true;
                    }

                    return $collAddressbookchangess;
                }

                if ($partial && $this->collAddressbookchangess) {
                    foreach ($this->collAddressbookchangess as $obj) {
                        if ($obj->isNew()) {
                            $collAddressbookchangess[] = $obj;
                        }
                    }
                }

                $this->collAddressbookchangess = $collAddressbookchangess;
                $this->collAddressbookchangessPartial = false;
            }
        }

        return $this->collAddressbookchangess;
    }

    /**
     * Sets a collection of ChildAddressbookchanges objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $addressbookchangess A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildAddressbooks The current object (for fluent API support)
     */
    public function setAddressbookchangess(Collection $addressbookchangess, ConnectionInterface $con = null)
    {
        /** @var ChildAddressbookchanges[] $addressbookchangessToDelete */
        $addressbookchangessToDelete = $this->getAddressbookchangess(new Criteria(), $con)->diff($addressbookchangess);


        $this->addressbookchangessScheduledForDeletion = $addressbookchangessToDelete;

        foreach ($addressbookchangessToDelete as $addressbookchangesRemoved) {
            $addressbookchangesRemoved->setAddressbooks(null);
        }

        $this->collAddressbookchangess = null;
        foreach ($addressbookchangess as $addressbookchanges) {
            $this->addAddressbookchanges($addressbookchanges);
        }

        $this->collAddressbookchangess = $addressbookchangess;
        $this->collAddressbookchangessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Addressbookchanges objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Addressbookchanges objects.
     * @throws PropelException
     */
    public function countAddressbookchangess(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collAddressbookchangessPartial && !$this->isNew();
        if (null === $this->collAddressbookchangess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAddressbookchangess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAddressbookchangess());
            }

            $query = ChildAddressbookchangesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAddressbooks($this)
                ->count($con);
        }

        return count($this->collAddressbookchangess);
    }

    /**
     * Method called to associate a ChildAddressbookchanges object to this object
     * through the ChildAddressbookchanges foreign key attribute.
     *
     * @param  ChildAddressbookchanges $l ChildAddressbookchanges
     * @return $this|\EcclesiaCRM\Addressbooks The current object (for fluent API support)
     */
    public function addAddressbookchanges(ChildAddressbookchanges $l)
    {
        if ($this->collAddressbookchangess === null) {
            $this->initAddressbookchangess();
            $this->collAddressbookchangessPartial = true;
        }

        if (!$this->collAddressbookchangess->contains($l)) {
            $this->doAddAddressbookchanges($l);

            if ($this->addressbookchangessScheduledForDeletion and $this->addressbookchangessScheduledForDeletion->contains($l)) {
                $this->addressbookchangessScheduledForDeletion->remove($this->addressbookchangessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildAddressbookchanges $addressbookchanges The ChildAddressbookchanges object to add.
     */
    protected function doAddAddressbookchanges(ChildAddressbookchanges $addressbookchanges)
    {
        $this->collAddressbookchangess[]= $addressbookchanges;
        $addressbookchanges->setAddressbooks($this);
    }

    /**
     * @param  ChildAddressbookchanges $addressbookchanges The ChildAddressbookchanges object to remove.
     * @return $this|ChildAddressbooks The current object (for fluent API support)
     */
    public function removeAddressbookchanges(ChildAddressbookchanges $addressbookchanges)
    {
        if ($this->getAddressbookchangess()->contains($addressbookchanges)) {
            $pos = $this->collAddressbookchangess->search($addressbookchanges);
            $this->collAddressbookchangess->remove($pos);
            if (null === $this->addressbookchangessScheduledForDeletion) {
                $this->addressbookchangessScheduledForDeletion = clone $this->collAddressbookchangess;
                $this->addressbookchangessScheduledForDeletion->clear();
            }
            $this->addressbookchangessScheduledForDeletion[]= clone $addressbookchanges;
            $addressbookchanges->setAddressbooks(null);
        }

        return $this;
    }

    /**
     * Clears out the collCardss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCardss()
     */
    public function clearCardss()
    {
        $this->collCardss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collCardss collection loaded partially.
     */
    public function resetPartialCardss($v = true)
    {
        $this->collCardssPartial = $v;
    }

    /**
     * Initializes the collCardss collection.
     *
     * By default this just sets the collCardss collection to an empty array (like clearcollCardss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCardss($overrideExisting = true)
    {
        if (null !== $this->collCardss && !$overrideExisting) {
            return;
        }

        $collectionClassName = CardsTableMap::getTableMap()->getCollectionClassName();

        $this->collCardss = new $collectionClassName;
        $this->collCardss->setModel('\EcclesiaCRM\Cards');
    }

    /**
     * Gets an array of ChildCards objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildAddressbooks is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCards[] List of ChildCards objects
     * @throws PropelException
     */
    public function getCardss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCardssPartial && !$this->isNew();
        if (null === $this->collCardss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCardss) {
                // return empty collection
                $this->initCardss();
            } else {
                $collCardss = ChildCardsQuery::create(null, $criteria)
                    ->filterByAddressbooks($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCardssPartial && count($collCardss)) {
                        $this->initCardss(false);

                        foreach ($collCardss as $obj) {
                            if (false == $this->collCardss->contains($obj)) {
                                $this->collCardss->append($obj);
                            }
                        }

                        $this->collCardssPartial = true;
                    }

                    return $collCardss;
                }

                if ($partial && $this->collCardss) {
                    foreach ($this->collCardss as $obj) {
                        if ($obj->isNew()) {
                            $collCardss[] = $obj;
                        }
                    }
                }

                $this->collCardss = $collCardss;
                $this->collCardssPartial = false;
            }
        }

        return $this->collCardss;
    }

    /**
     * Sets a collection of ChildCards objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $cardss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildAddressbooks The current object (for fluent API support)
     */
    public function setCardss(Collection $cardss, ConnectionInterface $con = null)
    {
        /** @var ChildCards[] $cardssToDelete */
        $cardssToDelete = $this->getCardss(new Criteria(), $con)->diff($cardss);


        $this->cardssScheduledForDeletion = $cardssToDelete;

        foreach ($cardssToDelete as $cardsRemoved) {
            $cardsRemoved->setAddressbooks(null);
        }

        $this->collCardss = null;
        foreach ($cardss as $cards) {
            $this->addCards($cards);
        }

        $this->collCardss = $cardss;
        $this->collCardssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Cards objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Cards objects.
     * @throws PropelException
     */
    public function countCardss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCardssPartial && !$this->isNew();
        if (null === $this->collCardss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCardss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCardss());
            }

            $query = ChildCardsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAddressbooks($this)
                ->count($con);
        }

        return count($this->collCardss);
    }

    /**
     * Method called to associate a ChildCards object to this object
     * through the ChildCards foreign key attribute.
     *
     * @param  ChildCards $l ChildCards
     * @return $this|\EcclesiaCRM\Addressbooks The current object (for fluent API support)
     */
    public function addCards(ChildCards $l)
    {
        if ($this->collCardss === null) {
            $this->initCardss();
            $this->collCardssPartial = true;
        }

        if (!$this->collCardss->contains($l)) {
            $this->doAddCards($l);

            if ($this->cardssScheduledForDeletion and $this->cardssScheduledForDeletion->contains($l)) {
                $this->cardssScheduledForDeletion->remove($this->cardssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildCards $cards The ChildCards object to add.
     */
    protected function doAddCards(ChildCards $cards)
    {
        $this->collCardss[]= $cards;
        $cards->setAddressbooks($this);
    }

    /**
     * @param  ChildCards $cards The ChildCards object to remove.
     * @return $this|ChildAddressbooks The current object (for fluent API support)
     */
    public function removeCards(ChildCards $cards)
    {
        if ($this->getCardss()->contains($cards)) {
            $pos = $this->collCardss->search($cards);
            $this->collCardss->remove($pos);
            if (null === $this->cardssScheduledForDeletion) {
                $this->cardssScheduledForDeletion = clone $this->collCardss;
                $this->cardssScheduledForDeletion->clear();
            }
            $this->cardssScheduledForDeletion[]= clone $cards;
            $cards->setAddressbooks(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->principaluri = null;
        $this->displayname = null;
        $this->uri = null;
        $this->description = null;
        $this->synctoken = null;
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
            if ($this->collAddressbookchangess) {
                foreach ($this->collAddressbookchangess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCardss) {
                foreach ($this->collCardss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collAddressbookchangess = null;
        $this->collCardss = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(AddressbooksTableMap::DEFAULT_STRING_FORMAT);
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
